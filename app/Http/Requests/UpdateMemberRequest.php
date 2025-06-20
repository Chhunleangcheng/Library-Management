<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('members', 'email')->ignore($this->member->id)
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'membership_date' => 'required|date|before_or_equal:today',
            'membership_status' => 'required|in:active,inactive,suspended',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ឈ្មោះពេញត្រូវតែបំពេញ',
            'name.string' => 'ឈ្មោះត្រូវតែជាអក្សរ',
            'name.max' => 'ឈ្មោះមិនអាចលើសពី 255 តួអក្សរទេ',
            'email.required' => 'អីមែលត្រូវតែបំពេញ',
            'email.email' => 'អីមែលត្រូវតែមានទម្រង់ត្រឹមត្រូវ',
            'email.unique' => 'អីមែលនេះមានរួចហើយ',
            'email.max' => 'អីមែលមិនអាចលើសពី 255 តួអក្សរទេ',
            'phone.max' => 'លេខទូរសព្ទមិនអាចលើសពី 20 តួអក្សរទេ',
            'address.max' => 'អាសយដ្ឋានមិនអាចលើសពី 500 តួអក្សរទេ',
            'date_of_birth.date' => 'ថ្ងៃកំណើតត្រូវតែជាកាលបរិច្ឆេទត្រឹមត្រូវ',
            'date_of_birth.before' => 'ថ្ងៃកំណើតត្រូវតែមុនថ្ងៃបច្ចុប្បន្ន',
            'membership_date.required' => 'ថ្ងៃចុះឈ្មោះត្រូវតែបំពេញ',
            'membership_date.date' => 'ថ្ងៃចុះឈ្មោះត្រូវតែជាកាលបរិច្ឆេទត្រឹមត្រូវ',
            'membership_date.before_or_equal' => 'ថ្ងៃចុះឈ្មោះមិនអាចលើសពីថ្ងៃបច្ចុប្បន្នទេ',
            'membership_status.required' => 'ស្ថានភាពសមាជិកត្រូវតែជ្រើសរើស',
            'membership_status.in' => 'ស្ថានភាពសមាជិកមិនត្រឹមត្រូវ',
        ];
    }
}
