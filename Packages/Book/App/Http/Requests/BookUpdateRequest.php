<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Packages\Book\App\Models\Pivots\BookUser;

final class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->book);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required',
            'status' => ['required', Rule::in(array_keys(BookUser::$statuses))],
        ];
    }
}
