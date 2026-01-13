<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $kycRequests = kycVerification::with('user')->paginate(25);
    return view('admin.kyc.index', compact('kycRequests'));
  }

  /**
   * Display the specified resource.
   */
  public function show(KycVerification $kyc): View
  {
    return view('admin.kyc.show', compact('kyc'));
  }

  /*
   * Télécharger un document
   */
  public function downloadDocument(int $id, int $index)
  {
    $kyc = KycVerification::findOrFail($id);
    $attachmentPath = null;

    foreach (json_decode($kyc->documents) as $key => $document) {
      if ($key == $index) {
        $attachmentPath = $document;
      }
    }

    if (Storage::exists($attachmentPath)) {
      return Storage::download($attachmentPath);
    }

    abort(404);
  }

  /**
   * Update KYC Status
   */
  public function updateStatus(Request $request, KycVerification $kyc): RedirectResponse
  {
    // valider le status
    $request->validate([
      'status' => ['required', 'in:pending,approved,rejected']
    ]);

    // récupérer le status depuis la requête
    $kyc->status = $request->status;
    $kyc->save();

    // si statut approved, maj le kyc_status de l'utilisateur
    if ($kyc->status == 'approved') {
      User::findOrFail($kyc->user_id)?->update(['kyc_status' => 1]);
    } else {
      User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
    }

    NotificationService::UPDATED();
    return to_route('admin.kyc.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
