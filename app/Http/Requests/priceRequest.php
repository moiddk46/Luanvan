<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class priceRequest extends FormRequest
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
            'content' => 'required|min:20',
            'files' => 'required|mimes:doc,docx,mpeng,mp4',
            'page'=> "required|min:1",
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
            'content.required' => 'Vui lòng nhập nội dung.',
            'content.min' => 'Nội dung quá ngắn.',
            'files.required' => 'Vui lòng chọn tệp',
            'files.mimes' => 'Tệp không phải dạng doc, docx, mpeng hoặc mp4.',
            'page.required'=>" Vui lòng nhập số trang",
            'page.min'=> 'Số trang phải lớn hơn hoặc bằng 1'
        ];
    }
}
