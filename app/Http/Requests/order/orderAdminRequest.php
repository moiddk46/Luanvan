<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class orderAdminRequest extends FormRequest
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
            'status' => 'required',
            'orderIds' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'status' => 'Vui lòng chọn trạng thái',
            'orderIds' => 'Vui lòng chọn đơn hàng',
        ];
    }
}
