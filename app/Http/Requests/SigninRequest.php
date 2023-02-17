<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SigninRequest extends FormRequest{
	public function rules():array{
		return [
			'email'=>[
				'required',
				'string',
				'email',
				'max:255',
				Rule::exists('users','email')->whereNotNull('email_verified_at')
			],
			'password'=>[
				'required',
				'string',
				'min:8',
				'max:255'
			]
		];
	}
}