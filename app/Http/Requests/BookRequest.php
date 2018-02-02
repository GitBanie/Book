<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'genre_id' => ['integer', 'in:0,1,2,3'],
            'authors' => 'required|array',
            'status' => 'in:published,unpublished',
            'picture' => 'image',
        ];
    }
}
