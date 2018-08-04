<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'signatures' => 'required',
            'warning_status' => 'required',

        ];

        foreach($this->request->get('items') as $key => $val)
        {
            $rules['items.'.$key] = 'required|max:10';
        }

        return $rules;


    }

    public function messages() {
        $messages = [];

        foreach($this->request->get('items') as $key => $val)
        {
            $messages['items.'.$key.'.max'] = 'The field labeled "Book Title '.$key.'" must be less than :max characters.';
        }
        return $messages;



    }


}
