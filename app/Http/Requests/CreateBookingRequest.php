<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateBookingRequest extends FormRequest{
	public function rules():array{
		return [
			'seat_no'=>[
				'required',
				'string',
				'regex:/^[A-Ta-t][1-9][0]?$/'
			],
			'no_of_seats'=>[
				'required',
				'numeric',
				'min:1',
				'max:5'
			]
		];
	}
}