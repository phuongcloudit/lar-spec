<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ProjectCategoryRequest extends FormRequest
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
            'name' => 'required|max:255|unique:App\Models\ProjectCategory,name',
            'slug' => 'required|alpha_dash|max:255|unique:App\Models\ProjectCategory,slug'
        ];
        if($this->isMethod('PUT') || $this->isMethod('PATCH')):
            $project_category = $this->route('project_category');
            $rules['name'] = 'required|max:255|unique:App\Models\ProjectCategory,name,'.$project_category->id;
            $rules['slug'] = 'required|max:255|unique:App\Models\ProjectCategory,slug,'.$project_category->id;
        endif;
        return $rules;
    }
}
