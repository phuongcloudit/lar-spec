<?php

namespace App\Http\Requests\Admin;

use App\Model\User;
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
            'donate_money' => 'required|numeric',
            'donate_day_end' => 'required|date',
            'content' => 'required',
            'author_id' => ['nullable', 'exists:users,id', new CanBeAuthor],
        ];
    }
}
