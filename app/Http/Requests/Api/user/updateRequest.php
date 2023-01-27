<?php

namespace App\Http\Requests\Api\user;

use App\Traits\response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateRequest extends FormRequest
{
    use response;
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
            'username'             => 'nullable|string|max:255|unique:users,username,'. auth('user_api')->user()->id,
            'name'                 => 'nullable|string|max:250',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->failed($validator->errors()->first(), 403, 'E03'));
    }
}
