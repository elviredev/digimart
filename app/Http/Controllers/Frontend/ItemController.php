<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
    return view('frontend.dashboard.item.index', compact('categories'));
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
      'html' => $html
    ], 200);
  }

  /**
   * Télécharger le fichier dans le storage et retourner un tableau avec les informations du fichier
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
        'size' => $file->getSize()
      ];

    } catch (Throwable $th) {
      throw $th;
    }

    return null;
  }

  public function itemDestroy(string $id)
  {
    $file = \App\Models\UploadedFile::whereId($id)->where('author_id', user()->id)->first();
    if(!$file) {
      return response()->json([
        'status' => 'error',
        'message' => __('File not found')
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
        'files' => $uploadedFiles
      ], 200);
    } catch (Throwable $th) {
      return response()->json([
        'status' => 'error',
        'message' => $th->getMessage()
      ], 200);
    }
  }
}



















