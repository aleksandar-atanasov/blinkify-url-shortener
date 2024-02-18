<?php

namespace Modules\ShortLink\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShortLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'original_url' => 'required|url:http,https',
            'custom_url' => 'nullable|string|max:16|unique:short_links,custom_url',
            'user_id' => 'nullable|exists:users,id',
            'domain' => 'required|string',
        ];
    }
}
