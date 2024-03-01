<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     *
     */
    public function rules(): array
    {
        return [
            "title" => "required",
            "description" => "required",
            "content" => "required",
            "event_date" => "required",
            "image" => "sometimes|file|image|max:10240",
            "sport_type_id" => "required",
            "TagsClubs" => "sometimes|array"
        ];
    }
}
