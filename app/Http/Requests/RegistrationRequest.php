<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'ime' => 'required|regex:/^[A-ZŽĐŠĆČ][a-zžđšćč]{1,19}$/',
            'prezime' => 'required|regex:/^[A-ZŽĐŠĆČ][a-zžđšćč]{1,19}(\s[A-ZŽĐŠĆČ][a-zžđšćč]{1,19})*$/',
            'email' => 'required|email|unique:korisnik,email',
            'pass' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/',
            'tel' => 'required|regex:/^[+][\d]{0,3}\/[\d]{3,7}\-[\d]{3}$/',
            'city' => 'required|regex:/^[A-ZŽĐŠĆČ][a-zžđšćč]{1,19}(\s[A-ZŽĐŠĆČ][a-zžđšćč]{1,19})*$/'
        ];
    }
}
