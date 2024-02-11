<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class saveEmployee extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'=>['required', 'min:10','max:15', Rule::unique('employees', 'id')],
            'firstName'=>['required', 'max:10', 'string'],
            'sureName'=>['required', 'max:10', 'string'],
            'thirdName'=>['required', 'max:10', 'string'],
            'lastName'=>['required', 'max:10', 'string'],
            'birthDate'=>['required', 'date'],
            'hiredAt'=>['required', 'date'],
            'religion'=>['required', 'string'],
            'email'=>['required', 'email', 'min:10', 'max:30', Rule::unique('employees', 'email')],
            'phone'=>['required',  'min:3','max:13', Rule::unique('employees', 'phone')],
            'address'=>['required', 'string', 'min:10','max:30'],
            'qualifications'=>['required', 'string', 'min:10','max:40'],
            'position'=>['required', 'string','min:4','max:15'],
            'department'=>['required', 'min:1','max:10'],
            'branch'=>['required', 'min:1','max:17'],
            'marital_status'=>['required', 'string', 'min:1','max:17'],
            'image'=>['required', 'image', 'dimensions:300', 'max:160000', Rule::unique('employees','image')],
            'gender'=>['required', 'string', 'min:3', 'max:5']
        ];
    }
}
