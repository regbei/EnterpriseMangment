<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class savePayroll extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'=>['required','max:20', Rule::unique('payrolls', 'employee_id')],
            'salary'=>['required','min:3'],
            'effectiveDate'=>['required', 'date'],
            'endDate'=>['required', 'date']
        ];
    }
}
