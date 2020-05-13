<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ReportTypeRequest extends FormRequest
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
            'name' => 'required|max:255|unique:App\Models\ReportType,name',
            'slug' => 'required|alpha_dash|max:255|unique:App\Models\ReportType,slug'
        ];
       
        if($this->isMethod('PUT') || $this->isMethod('PATCH')):
            $report_type = $this->route('report_type');
            $rules['name'] = 'required|max:255|unique:App\Models\ReportType,name,'.$report_type->id;
            $rules['slug'] = 'required|max:255|unique:App\Models\ReportType,slug,'.$report_type->id;
        endif;
        return $rules;
    }
}
