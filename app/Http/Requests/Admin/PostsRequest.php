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
        return [
            'title' => 'required',
            'category_id' => 'required|numeric',
            'donate_day_end' => 'required|date',
            // 'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'images' => 'required',
            // 'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author_id' => ['nullable', 'exists:users,id', new CanBeAuthor],
        ];
    }
}
