<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewUserRequest extends FormRequest
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
	        'first_name' => 'required|string|max:255',
	        'last_name'  => 'sometimes|nullable|string|max:255',
	        'email'      => 'sometimes|nullable|string|email|max:255|unique:users',
	        'phone'      => 'sometimes|nullable|numeric|digits:8|unique:users',
	        'color'      => 'required|integer|unique:users,color_id',
	        'role'       => 'required|numeric|min:2'
        ];
    }
}
