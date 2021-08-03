<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'company_id' => [
                'integer',
                'exists:companies,id',
                'required',
            ],
            'email_address' => [
                'required',
                'unique:employees,email_address,' . request()->route('employee')->id,
            ],
            'phone_number' => [
                'string',
                'required',
                'unique:employees,phone_number,' . request()->route('employee')->id,
            ],
        ];
    }
}