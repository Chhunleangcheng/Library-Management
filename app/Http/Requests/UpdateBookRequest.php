<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'isbn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('books', 'isbn')->ignore($this->book->id)
            ],
            'description' => 'nullable|string|max:1000',
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'total_copies' => 'required|integer|min:1|max:999',
            'available_copies' => 'required|integer|min:0|lte:total_copies',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'ចំណងជើងសៀវភៅត្រូវតែបំពេញ',
            'author.required' => 'ឈ្មោះអ្នកនិពន្ធត្រូវតែបំពេញ',
            'genre.required' => 'ប្រភេទសៀវភៅត្រូវតែជ្រើសរើស',
            'isbn.required' => 'លេខ ISBN ត្រូវតែបំពេញ',
            'isbn.unique' => 'លេខ ISBN នេះមានរួចហើយ',
            'total_copies.required' => 'ចំនួនសៀវភៅសរុបត្រូវតែបំពេញ',
            'available_copies.required' => 'ចំនួនដែលអាចខ្ចីបានត្រូវតែបំពេញ',
            'available_copies.lte' => 'ចំនួនដែលអាចខ្ចីបានមិនអាចច្រើនជាងចំនួនសរុបទេ',
            'published_year.max' => 'ឆ្នាំបោះពុម្ពមិនអាចច្រើនជាងឆ្នាំបច្ចុប្បន្នទេ',
        ];
    }
}
