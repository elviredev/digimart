<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItemStatusUpdateRequest;
use App\Models\Item;
use App\Models\ItemHistory;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class ItemReviewController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Module Review Item */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:review products')
    ];
  }

  /**
   * @desc Afficher la liste des items en attente de validation
   */
  public function pendingIndex(): View
  {
    $items = Item::where('status', 'pending')->paginate(10);
    return view('admin.item-review.pending-index', compact('items'));
  }

  /**
   * @desc Afficher la liste des items approuvés
   */
  public function approvedIndex(): View
  {
    $items = Item::where('status', 'approved')->paginate(10);
    return view('admin.item-review.approved-index', compact('items'));
  }

  /**
   * @desc Afficher la liste des items rejetés définitivement
   */
  public function hardRejectedIndex(): View
  {
    $items = Item::where('status', 'hard_rejected')->paginate(10);
    return view('admin.item-review.hard-rejected-index', compact('items'));
  }

  /**
   * @desc Afficher la liste des items rejetés temporairement
   */
  public function softRejectedIndex(): View
  {
    $items = Item::where('status', 'soft_rejected')->paginate(10);
    return view('admin.item-review.soft-rejected-index', compact('items'));
  }

  /**
   * @desc Afficher la liste des items resoumis
   */
  public function resubmittedIndex(): View
  {
    $items = Item::where('status', 'resubmitted')->paginate(10);
    return view('admin.item-review.resubmitted-index', compact('items'));
  }



  /**
  * @desc Afficher un item en particulier
  */
  public function show(string $id): View
  {
    $item = Item::with('histories')->findOrFail($id);
    return view('admin.item-review.show', compact('item'));
  }

  /**
   * Modifier le status d'un item
   * Enregistrer le nouvel historique
   * Envoyer un email à l'auteur quand le statut a été modifié
   */
  public function updateStatus(ItemStatusUpdateRequest $request, string $id): RedirectResponse
  {
    // Récupérer Item en BDD et enregistrer la mise à jour du statut en BDD
    $item = Item::findOrFail($id);
    $item->status = $request->status;
    $item->save();

    // Enregistrer l'historique du changement de statut dans la table `item_histories`
    $history = new ItemHistory();
    $history->item_id = $item->id;
    $history->author_id = $item->author_id;
    $history->status = $request->status;
    $history->reviewer_id = admin()->id;

    switch ($request->status) {
      case 'approved':
        $history->title = 'Item approved';
        $history->body = 'Congratulations! Your item has been approved.';
        break;
      case 'soft_rejected':
        $history->title = 'Item soft rejected';
        $history->body = $request->reason;
        break;
      case 'hard_rejected':
        $history->title = 'Item hard rejected';
        $history->body = $request->reason;
        break;
    }

    $history->save();

    // Send Mail to Author
    MailSenderService::sendMail(
      name: $item->author->name,
      subject: "$history->title | $item->name",
      content: $history->body,
      toMail: $item->author->email
    );

    NotificationService::UPDATED();

    return redirect()->back();
  }

  /**
   * Télécharger le fichier principal d'un item
   */
  public function itemDownload(string $id)
  {
    $item = Item::whereId($id)->firstOrFail();

    if (Storage::disk('local')->exists($item->main_file)) {
      return Storage::disk('local')->download($item->main_file);
    }

    abort(404);
  }
}



















