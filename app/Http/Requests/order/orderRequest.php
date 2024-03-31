<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class orderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:8',
            'address' => 'required|min:20',
            'sdt' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'files.*.file' => 'required|mimes:doc,docx',
            'files.*.quantity' => 'required|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 8 ký tự',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.min' => 'Địa chỉ email không hợp lệ.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.regex' => 'Số điện thoại không đúng định dạng',
            'files.*.file.required' => 'Vui lòng chọn tệp',
            'files.*.file.mimes' => 'Tệp không phải dạng doc hoặc docx',
            'files.*.quantity.required' => 'Vui lòng chọn số lượng bạn cần',
            'files.*.quantity.min' => 'Số lượng phải từ 1 trở lên',
        ];
    }
}
