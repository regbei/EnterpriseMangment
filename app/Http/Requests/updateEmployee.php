<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateEmployee extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstName'=>['required', 'max:10', 'string'],
            'sureName'=>['required', 'max:10', 'string'],
            'thirdName'=>['required', 'max:10', 'string'],
            'lastName'=>['required', 'max:10', 'string'],
            'email'=>['required', 'email', 'min:10', 'max:30'],
            'phone'=>['required','min:6','max:11'],
            'address'=>['required', 'string', 'min:10','max:30'],
            'hiredAt'=>['required','date'],
            'qualifications'=>['required', 'string', 'min:10','max:40'],
            'position'=>['required',  'min:4','max:15'],
            'martial_status'=>['required',  'min:4','max:15'],
            'department'=>['required', 'integer', 'min:1','max:10'],
            'branch'=>['required', 'integer', 'min:1','max:17'],
            'image'=>['image', 'max:160000']
        ];
    }
}
