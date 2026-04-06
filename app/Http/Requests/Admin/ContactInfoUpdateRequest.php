<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactInfoUpdateRequest extends FormRequest
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
      'phone_one' => ['nullable', 'string', 'max:50'],
      'phone_two' => ['nullable', 'string', 'max:50'],
      'email_one' => ['nullable', 'email', 'max:100'],
      'email_two' => ['nullable', 'email', 'max:100'],
      'link_one' => ['nullable', 'string', 'max:255'],
      'link_two' => ['nullable', 'string', 'max:255'],
      'map' => ['nullable'],
    ];
  }
}
