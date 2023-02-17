<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\{SigninRequest,SignupRequest};
use App\Models\User;
use Hash,Exception,Log;
class AuthController extends Controller{
	public function __construct(){}
	public function signin(SigninRequest $request):JsonResponse{
		if(auth('web')->attempt([
			'email'=>$request->validated('email'),
			'password'=>$request->validated('password')
		])){
			$user = auth('api')->user();
			$token = $user->createToken('token')->plainTextToken;
			return response()->success([
				'token'=>$token,
				'message'=>__('Log in successful')
			]);
		}
		return response()->error([
			'message'=>__('Email or Password is Incorrect')
		]);
	}
	public function signup(SignupRequest $request):JsonResponse{
		try{
			$user = User::create([
				'name'=>$request->validated('name'),
				'email'=>$request->validated('email'),
				'email_verified_at'=>now(),//temporary
				'password'=>Hash::make($request->validated('password'))
			]);
			$token = $user->createToken('token')->plainTextToken;
			return response()->success([
				'token'=>$token,
				'message'=>__('Log in successful')
			]);
		}catch(Exception $e){
			Log::debug($e->getMessage());
		}
		return response()->error([
			'message'=>__('Some unknown error occured. Please try again')
		]);
	}
}