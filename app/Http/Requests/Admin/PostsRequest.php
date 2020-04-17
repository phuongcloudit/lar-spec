<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Rules\CanBeAuthor;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostsRequest extends FormRequest
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
       
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules =  [
            'category_id'   =>  'required|exists:App\Models\Category,id',
            'title' => 'required|max:255|unique:App\Models\Post,title',
            'slug' => 'required|alpha_dash|max:255|unique:App\Models\Post,slug'
        ];
        if($this->isMethod('PUT') || $this->isMethod('PATCH')):
            $post = $this->route('post');
            $rules['title'] = 'required|max:255|unique:App\Models\Post,title,'.$post->id;
            $rules['slug'] = 'required|max:255|unique:App\Models\Post,slug,'.$post->id;
        endif;
        return $rules;
    }
}
