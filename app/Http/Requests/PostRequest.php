<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class PostRequest extends FormRequest
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
            "title" => "required|string|max:255",
            "image" => "sometimes|file|image|max:10240", // for example, allowing up to 10MB images
            "content" => "required|string",
            "publish_date" => "required|date",
            "tags" => "sometimes|array",
            "user_id" => "required",
            "category_id" => "required"
            // remove the 'image_url' rule as it's not relevant here
        ];
    }

}
