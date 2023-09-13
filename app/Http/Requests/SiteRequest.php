<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required",
            "domen" => "required|min:6",
            "link" => "required|min:6",
            // "iterable" => "required",
            // "title" => "required",
            // "title2" => "required",
            // "price" => "required",
            // "company" => "required",
            // "country" => "required",
            // "items_per_page" => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Site Başlığı qeyd edin',
            'domen.min' => 'Link minimum :min simvol olmalidir',
            'link.min' => 'Link minimum :min simvol olmalidir',
            'domen.required' => 'Domen qeyd edin',
            'link.required' => 'Məhsul siyahısı linki qeyd edin',
        ];
    }
}
