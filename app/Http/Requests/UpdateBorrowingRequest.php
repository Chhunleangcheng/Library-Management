<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after:borrowed_at',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
            'fine_amount' => 'nullable|numeric|min:0',
            'fine_paid' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'member_id.required' => 'សមាជិកត្រូវតែជ្រើសរើស',
            'member_id.exists' => 'សមាជិកមិនត្រឹមត្រូវ',
            'book_id.required' => 'សៀវភៅត្រូវតែជ្រើសរើស',
            'book_id.exists' => 'សៀវភៅមិនត្រឹមត្រូវ',
            'borrowed_at.required' => 'ថ្ងៃខ្ចីត្រូវតែបំពេញ',
            'borrowed_at.date' => 'ថ្ងៃខ្ចីត្រូវតែជាកាលបរិច្ឆេទត្រឹមត្រូវ',
            'due_date.required' => 'ថ្ងៃត្រូវត្រឡប់ត្រូវតែបំពេញ',
            'due_date.date' => 'ថ្ងៃត្រូវត្រឡប់ត្រូវតែជាកាលបរិច្ឆេទត្រឹមត្រូវ',
            'due_date.after' => 'ថ្ងៃត្រូវត្រឡប់ត្រូវតែក្រោយថ្ងៃខ្ចី',
            'returned_at.date' => 'ថ្ងៃត្រឡប់ត្រូវតែជាកាលបរិច្ឆេទត្រឹមត្រូវ',
            'returned_at.after_or_equal' => 'ថ្ងៃត្រឡប់ត្រូវតែក្រោយ ឬ ស្មើថ្ងៃខ្ចី',
            'fine_amount.numeric' => 'ចំនួនការពិន័យត្រូវតែជាលេខ',
            'fine_amount.min' => 'ចំនួនការពិន័យមិនអាចតិចជាង 0',
        ];
    }
}
