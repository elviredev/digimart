<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Models\User;
use App\Services\MailSenderService;
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
    $kycRequests = kycVerification::with('user')->latest()->paginate(25);
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
    // valider status & reason
    $request->validate([
      'status' => ['required', 'in:pending,approved,rejected'],
      'reason' => ['nullable', 'string', 'max:500']
    ]);

    // récupérer status & reason depuis la requête
    $kyc->status = $request->status;
    $kyc->reject_reason = $request->reason;
    $kyc->save();

    // si statut approved, maj le kyc_status de l'utilisateur + email to user
    if ($kyc->status == 'approved') {
      User::findOrFail($kyc->user_id)?->update(['kyc_status' => 1, 'user_type' => 'author']);
      // envoyer email approve
      MailSenderService::sendMail(
        name: $kyc->user->name,
        subject: __('Your KYC has been approved'),
        content: __('We are happy to inform you that your KYC has been approved.'),
        toMail: $kyc->user->email
      );
    } elseif ($kyc->status == 'rejected') {
      User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
      // envoyer email rejet
      MailSenderService::sendMail(
        name: $kyc->user->name,
        subject: __('Your KYC has been rejected'),
        content: $kyc->reject_reason ?? __('We are sorry to inform you that your KYC has been rejected.'),
        toMail: $kyc->user->email
      );
    } else {
      User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
    }

    NotificationService::UPDATED();
    return to_route('admin.kyc.index');
  }

}
