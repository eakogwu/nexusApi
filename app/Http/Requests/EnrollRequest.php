<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollRequest extends FormRequest
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|email|unique:enrolls',
            'phone' => 'required|max:255',
            'agree' => 'accepted',
        ];
    }

    public function messages()
    {
        return [
            'agree.accepted' => 'You must accept out terms and conditions',
            'email.unique'   => 'Seems your information already exist with us'
        ];
    }
}
