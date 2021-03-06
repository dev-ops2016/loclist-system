<?php

namespace App\Http\Requests\Maintainance\Presentation;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePresentationMode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userType ==1 ? true : false ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'presentation_mode' => 'required|unique:mode_of_presentations,presentation_mode,'.$this->get('id')
        ];
    }
}
