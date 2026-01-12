<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KycVerificationStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'document_type' => ['required', 'string', 'in:nid,passport'],
      'document_number' => ['required', 'string', 'max:40'],
      'documents' => ['required', 'array', 'min:1'],
      'documents.*' => ['required', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:5000'],
    ];
  }
}
