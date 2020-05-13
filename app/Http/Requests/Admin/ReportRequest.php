<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'report_type_id'        =>  'required',
            'title'                 =>  'required|max:255|unique:App\Models\Report,title',
            'slug'                  =>  'required|max:255|unique:App\Models\Report,slug',
            'date'                  =>  'required',
           
        ];
        if($this->isMethod('PUT') || $this->isMethod('PATCH')):
            $report = $this->route('report');
            $rules['title'] = 'required|max:255|unique:App\Models\Report,title,'.$report->id;
            $rules['slug'] = 'required|max:255|unique:App\Models\Report,slug,'.$report->id;
        endif;
        return $rules;
    }
}