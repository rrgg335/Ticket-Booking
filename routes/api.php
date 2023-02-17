<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController,BookingsController};
Route::post('signin',[AuthController::class,'signin']);
Route::post('signup',[AuthController::class,'signup']);
Route::group(['middleware'=>['auth:api']],function(){
	Route::prefix('bookings')->group(function(){
		Route::post('/',[BookingsController::class,'create']);
	});
});