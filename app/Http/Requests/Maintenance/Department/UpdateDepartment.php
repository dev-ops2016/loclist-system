<?php

namespace App\Http\Requests\Maintainance\Department;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userType == 1? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department_name' => 'required|unique:departments,department_name,'.$this->get('id')
        ];
    }
}
