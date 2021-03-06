<?php

namespace App\Http\Requests\clients\Calls;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueClientRecord;

class UpdateClientCall extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userType != 3 ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'caller' => 'required',
            'date_of_call' => ['required', 
                new UniqueClientRecord('client_calls', 
                'client_id' , 
                'company_id', 
                'caller',
                $this->get('id') 
            )],
            'confirmation_preCall' => 'required',
            'productive_call' => 'required',
            'proposal_sent' => 'required',
            'client_response' => 'required',
            'client_id' => 'required',
            'company_id' => 'required',
        ];
    }
}
