<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemStoreRequest;
use App\Http\Requests\Frontend\ItemUpdateRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemChangelog;
use App\Models\ItemHistory;
use App\Services\NotificationService;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;


class ItemController extends Controller
{
  use FileUploadTrait;

  /**
  * Display a listing of the resource.
  */
  public function index(): View
  {
    $categories = Category::all();
    $items = Item::with(['category', 'subCategory'])
      ->where('author_id', user()->id)
      ->latest()
      ->paginate(10);
    return view('frontend.dashboard.item.index', compact('categories', 'items'));
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create(Request $request)
  {
    $categories = Category::all();
    $selectedCategory = Category::with('subCategories')->whereSlug($request->category)->firstOrFail();

    // Put category id in session
    session()->put('selected_category', $selectedCategory->id);

    // Récupérer les fichiers téléchargés
    $uploadedItems = \App\Models\UploadedFile::
                    where('author_id', user()->id)
                    ->where('category_id', session()->get('selected_category'))
                    ->get();

    return view('frontend.dashboard.item.create', compact('selectedCategory', 'categories', 'uploadedItems'));
  }

  /**
   * Upload multiple files
   * @return JsonResponse
   */
  public function itemUploads(Request $request)
  {
    // Récupérer la catégorie depuis la session puis les extensions autorisées
    $categorySupportedExtensions = Category::find(session()->get('selected_category'))->file_types;
    $extensions = Str::lower(implode(',', $categorySupportedExtensions));
    // Validation des extensions du fichier
    $request->validate([
      'file.*' => ['required', 'mimes:' . $extensions],
    ]);

    foreach($request->file('file') as $file) {
      $fileInfos = $this->uploadFile($file);

      if($fileInfos) {
        $uploadedFile = new \App\Models\UploadedFile();
        $uploadedFile->author_id = user()->id;
        $uploadedFile->category_id = session()->get('selected_category');
        $uploadedFile->name = $fileInfos['name'];
        $uploadedFile->extension = $fileInfos['extension'];
        $uploadedFile->mime_type = $fileInfos['mimeType'];
        $uploadedFile->path = $fileInfos['path'];
        $uploadedFile->size = $fileInfos['size'];
        $uploadedFile->save();
      }
    }
    // Récupérer les infos du fichier dans la table uploaded_files
    $uploadedFiles = \App\Models\UploadedFile::
            where('author_id', user()->id)
            ->where('category_id', session()->get('selected_category'))
            ->get();

    $html = \view('frontend.dashboard.layouts.partials.file-list-item', compact('uploadedFiles'))->render();

    // Renvoyer les infos du fichier dans un tableau JSON
    return response()->json([
      'files' => $uploadedFiles,
      'html' => $html,
    ], 200);
  }

  /**
   * Télécharger le fichier dans le storage et retourner un tableau avec les informations du fichier
   * @param UploadedFile $file
   * @param string $dir
   * @param string $disk
   * @return array|null
   * @throws Exception|Throwable
   */
  public function uploadFile(UploadedFile $file, string $dir = "uploads/items", string $disk = 'local'): ?array
  {
    // valider le type de disk
    if(!in_array($disk, ['public', 'local'])) {
      throw new Exception("Invalid disk type. Disk must be either 'public' or 'local'");
    }

    try {
      // générer un fichier unique
      $filename = uniqid() . '.' . $file->getClientOriginalExtension();
      // store the file
      $file->storeAs($dir, $filename, $disk);

      return [
        'name' => $file->getClientOriginalName(),
        'extension' => $file->getClientOriginalExtension(),
        'mimeType' => $file->getMimeType(),
        'path' => "/$dir/$filename",
        'size' => $file->getSize(),
      ];

    } catch (Throwable $th) {
      throw $th;
    }

    return null;
  }

  /**
   * Supprimer un fichier
   * @param string $id
   * @return JsonResponse
   */
  public function itemDestroy(string $id)
  {
    $file = \App\Models\UploadedFile::whereId($id)->where('author_id', user()->id)->first();
    if(!$file) {
      return response()->json([
        'status' => 'error',
        'message' => __('File not found'),
      ], 200);
    }

    try {
      // Supprimer le fichier du storage FileUploadTrait
      $this->deleteFile($file->path, 'local');
      // Supprimer le fichier de la table uploaded_files
      $file->delete();

      // Récupérer les infos du fichier dans la table uploaded_files
      $uploadedFiles = \App\Models\UploadedFile::
      where('author_id', user()->id)
        ->where('category_id', session()->get('selected_category'))
        ->get();

      return response()->json([
        'status' => 'success',
        'message' => __('Item removed successfully'),
        'files' => $uploadedFiles,
      ], 200);
    } catch (Throwable $th) {
      return response()->json([
        'status' => 'error',
        'message' => $th->getMessage(),
      ], 200);
    }
  }
  
  /**
  * Store a newly created resource in storage.
  */
  public function storeItem(ItemStoreRequest $request): JsonResponse
  {
    $item = new Item();
    $item->author_id = user()->id;
    $item->name = $request->name;
    $item->description = $request->description;
    $item->category_id = $request->category;
    $item->sub_category_id = $request->sub_category;
    $item->version = $request->version;
    $item->demo_link = $request->demo_link;
    $item->tags = $request->tags;
    $item->preview_type = $request->preview_type;
    $item->preview_image = $request->preview_file;
    $item->preview_video = $request->preview_file;
    $item->preview_audio = $request->preview_file;
    $item->main_file = $request->source_type == 'upload' ? $request->upload_source : $request->link_source;
    $item->is_main_file_external = $request->source_type == 'upload' ? 0 : 1;
    $item->screenshots = $request->screenshots;
    $item->price = $request->price;
    $item->discount_price = $request->discount_price;
    $item->is_supported = $request->support;
    $item->support_instructions = $request->support_instructions;
    $item->status = 'pending';
    $item->is_free = $request->is_free;
    $item->save();

    /** Move public files in public folder */
    $publicFiles = $request->screenshots ?? [];
    $publicFiles[] = $request->preview_file ?? '';

    foreach ($publicFiles as $file) {
      if(File::exists(storage_path('app/private/' .$file))) {
        File::move(storage_path('app/private/' .$file), public_path($file));
      }
    }

    // Store initial history
    $itemHistory = new ItemHistory();
    $itemHistory->author_id = user()->id;
    $itemHistory->item_id = $item->id;
    $itemHistory->title = 'Initial Submission';
    $itemHistory->status = 'pending';
    $itemHistory->body = $request->message_for_reviewer;
    $itemHistory->save();

    // Supprimer les données dans la table 'uploaded_files'
    \App\Models\UploadedFile::where('category_id', $item->category_id)
      ->where('author_id', user()->id)?->delete();

    NotificationService::CREATED();

    return response()->json([
      'status' => 'success',
      'redirect' => route('user.items.index'),
    ], 200);
  }
  
  /**
  * Show the form for editing the specified resource.
  */
  public function editItem(string $id): View
  {
    $categories = Category::all();
    $item = Item::with(['category', 'subCategory'])->whereId($id)->where('author_id', user()->id)->firstOrFail();
    $uploadedItems = \App\Models\UploadedFile::
    where('author_id', user()->id)
      ->where('category_id', $item->category_id)
      ->get();

    // Put category id in session
    session()->put('selected_category', $item->category->id);

    return view('frontend.dashboard.item.edit', compact('item', 'categories', 'uploadedItems'));
  }

  /**
  * Update the specified resource
  */
  public function updateItem(ItemUpdateRequest $request, string $id)
  {
    $item = Item::whereId($id)->where('author_id', user()->id)->firstOrFail();

    if ($item->status !== 'approved' || $item->status !== 'soft_rejected') return abort(404);

    $item->name = $request->name;
    $item->description = $request->description;
    $item->version = $request->version;
    $item->demo_link = $request->demo_link;
    $item->tags = $request->tags;
    if($request->filled('preview_type')) $item->preview_type = $request->preview_type;
    if($request->filled('preview_file')) $item->preview_image = $request->preview_file;
    if($request->filled('preview_file')) $item->preview_video = $request->preview_file;
    if($request->filled('preview_file')) $item->preview_audio = $request->preview_file;
    if($request->filled('source_type')) $item->main_file = $request->source_type == 'upload' ? $request->upload_source : $request->link_source;
    if($request->filled('source_type')) $item->is_main_file_external = $request->source_type == 'upload' ? 0 : 1;
    if($request->filled('screenshots'))$item->screenshots = $request->screenshots;
    $item->price = $request->price;
    $item->discount_price = $request->discount_price;
    $item->is_supported = $request->support;
    $item->support_instructions = $request->support_instructions;
    $item->status = 'resubmitted';
    $item->is_free = $request->is_free;
    $item->save();

    /** Move public files in public folder */
    $publicFiles = $request->screenshots ?? [];
    if($request->filled('preview_file')) $publicFiles[] = $request->preview_file ?? '';

    foreach ($publicFiles as $file) {
      if(File::exists(storage_path('app/private/' .$file))) {
        File::move(storage_path('app/private/' .$file), public_path($file));
      }
    }

    // Supprimer les données dans la table 'uploaded_files'
    \App\Models\UploadedFile::where('category_id', $item->category_id)
      ->where('author_id', user()->id)?->delete();

    NotificationService::UPDATED();

    return response()->json([
      'status' => 'success',
      'redirect' => route('user.items.index'),
    ], 200);
  }

  /**
  * Download the specified resource
  */
  public function itemDownload(string $id)
  {
    $item = Item::whereId($id)->where('author_id', user()->id)->firstOrFail();

    if (Storage::disk('local')->exists($item->main_file)) {
      return Storage::disk('local')->download($item->main_file);
    }

    abort(404);
  }

  /**
  * Display the changelog of the specified resource.
  */
  public function itemChangelog(string $id): View
  {
    $item = Item::whereId($id)->where('author_id', user()->id)->firstOrFail();

    return view('frontend.dashboard.item.changelog', compact('item'));
  }

  /**
  * Display the history of the specified resource.
  */
  public function itemHistory(string $id): View
  {
    $histories = ItemHistory::where('item_id', $id)->latest()->get();
    $item = Item::whereId($id)->where('author_id', user()->id)->firstOrFail();
    return view('frontend.dashboard.item.history', compact('item', 'histories'));
  }

  public function storeChangelog(Request $request, string $id): RedirectResponse
  {
    $request->validate([
      'version' => ['required', 'string', 'max:30'],
      'description' => ['required', 'string', 'max:1000'],
    ]);

    $item = Item::whereId($id)->where('author_id', user()->id)->firstOrFail();

    if ($item->status !== 'approved') return abort(404);

    $changelog = new ItemChangelog();
    $changelog->version = $request->version;
    $changelog->description = $request->description;
    $changelog->item_id = $item->id;
    $changelog->save();

    NotificationService::CREATED();

    return redirect()->back();
  }
}



















