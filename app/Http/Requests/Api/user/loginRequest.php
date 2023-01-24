<?php

namespace App\Http\Requests\Api\user;

use App\Traits\response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class loginRequest extends FormRequest
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
            'username'          => 'required|string',
            'password'          => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->failed($validator->errors()->first(), 403, 'E03');
    }
}
