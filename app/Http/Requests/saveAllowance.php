<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveAllowance extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'emp_id'=>['required', 'min:10','max:15'],
            'type'=>['required', 'max:10'],
            'amount'=>['required', 'max:10'],
            'stmt'=>['required', 'string', 'max:50'],
            'effectiveDate'=>['required', 'date'],
            'endDate'=>['required', 'date']
        ];
    }
}
