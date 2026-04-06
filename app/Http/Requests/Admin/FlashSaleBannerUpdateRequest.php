<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FlashSaleBannerUpdateRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'offer' => ['required', 'string', 'max:255'],
      'button_text' => ['required', 'string', 'max:255'],
      'button_url' => ['required', 'string', 'max:255'],
      'status' => ['required', 'boolean'],
    ];
  }
}
