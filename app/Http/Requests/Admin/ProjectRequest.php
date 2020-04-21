<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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

    public function rules(): array
    {
        $rules =  [          
            'project_category_id'   =>  'required|exists:App\Models\ProjectCategory,id',
            'name'                  => 'required|max:255|unique:App\Models\Project,name',
            'slug'                  => 'required|max:255|unique:App\Models\Project,slug',
            'end_time'              =>  'required',
            "recruiter_avatar"     =>  'required',
            "recruiter_name"       =>  'required',
            "recruiter_content"    =>  'required'
        ];
        if($this->isMethod('PUT') || $this->isMethod('PATCH')):
            $project = $this->route('project');
            $rules['name'] = 'required|max:255|unique:App\Models\Project,name,'.$project->id;
            $rules['slug'] = 'required|max:255|unique:App\Models\Project,slug,'.$project->id;
        endif;
        return $rules;
    }
}
