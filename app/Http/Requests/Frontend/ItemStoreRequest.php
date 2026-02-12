<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
      'name' => ['required', 'string', 'max:255'],
      'description' => ['required', 'string'],
      'category' => ['required', 'exists:categories,id'],
      'sub_category' => ['required', 'exists:sub_categories,id'],
      'version' => ['required', 'string', 'max:20'],
      'demo_link' => ['nullable', 'url'],
      'tags' => ['required', 'array'],
      'preview_type' => ['required', 'in:image,video,audio'],
      'preview_file' => ['required'],
      'source_type' => ['required', 'in:upload,link'],
      'upload_source' => ['required_if:source_type,upload', 'nullable', 'string', 'max:255'],
      'link_source' => ['required_if:source_type,link', 'nullable', 'string', 'max:255'],
      'screenshots' => ['nullable'],
      'support' => ['required', 'in:0,1'],
      'support_instructions' => ['nullable'],
      'price' => ['required', 'numeric', 'min:1'],
      'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
      'is_free' => ['required', 'in:0,1'],
      'message_for_reviewer' => ['nullable', 'max:1000']
    ];
  }

  // Messages personnalisés
  public function messages():array
  {
    return [
      'discount_price.lt' => __('The discount price must be less than the regular price.')
    ];
  }
}
