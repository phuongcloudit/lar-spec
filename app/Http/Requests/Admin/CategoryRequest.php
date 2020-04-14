<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    public function rules(): array
    {
        $rules =  [
            'name' => 'required|max:255|unique:categories,name',
            'slug' => 'required|alpha_dash|max:255|unique:categories,slug'
        ];
        if($this->isMethod('PUT') || $this->isMethod('PATCH')):
            $id = $this->route('category');
            $rules['name'] = 'required|max:255|unique:categories,name,'.$id;
            $rules['slug'] = 'required|max:255|unique:categories,slug,'.$id;
        endif;
        return $rules;
    }
}
