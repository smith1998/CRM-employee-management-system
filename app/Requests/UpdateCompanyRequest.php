<?php

namespace App\Http\Requests;

use App\Models\Company;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:companies,name,' . request()->route('company')->id,
            ],
            'email_address' => [
                'required',
                'unique:companies,email_address,' . request()->route('company')->id,
            ],
            'logo' => [
                'array',
                'required',
            ],
            'logo.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }
}