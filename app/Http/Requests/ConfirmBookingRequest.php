<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ConfirmBookingRequest extends FormRequest{
	public function rules():array{
		return [
			'seats'=>[
				'required',
				'array',
				'min:1',
				'max:5'
			],
			'seats.*'=>[
				'required',
				'string',
				'regex:/^[A-Ta-t][1-9][0]?$/'
			]
		];
	}
}