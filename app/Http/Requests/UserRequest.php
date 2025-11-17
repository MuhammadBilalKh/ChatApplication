<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'signup_username' => "required|unique:users,username",
            'signup_email' => "required|email|unique:users,email",
            'signup_password' => "required|min:8",
            'signup_password_confirm' => 'required|same:signup_password',
            'field_1' => "required",
            'signup_profile_picture' => "required|image",
        ];
    }

    public function messages(): array
    {
        return [
            'signup_username.required' => "Username is Required",
            "signup_username.unique" => "This Username is Already Taken",
            'signup_email.required' => "Email Addres is Required",
            'signup_email.email' => "Invalid Email Address",
            "singup_email.unique" => "This Email Address Is Already Exist",
            'signup_password.required' => "Password Is Required",
            'signup_password.min' => "Minimum 8 Characters Are Required",
            'signup_password_confirm.required' => 'Password Confirmation is Required',
            'signup_password_confirm.same' => 'Password and Confirm Password Mismatch',
            'field_1.required' => "Name is Required",
            "signup_profile_picture.required" => "Profile Picutre is Required",
        ];
    }
}
