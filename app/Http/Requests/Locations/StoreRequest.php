<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'title' => ['required','string','max:255', Rule::unique('locations')->where(function ($query) {
                return $query->where('dataUrl', transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove', $this->title));
            })],
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'file' => 'required|file|max:10240|mimes:zip',
        ];
    }
}
