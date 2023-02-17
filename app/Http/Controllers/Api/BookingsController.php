<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\{Booking,User};
use App\Http\Requests\CreateBookingRequest;// For validation
use Exception,Log;
class BookingsController extends Controller{
	public function __construct(){}
	public function create(CreateBookingRequest $request):JsonResponse{
		$seat_no = $request->validated('seat_no');
		$no_of_seats = $request->validated('no_of_seats');
		$seats_to_book = [$seat_no];
		$column_number = substr($seat_no,0,1);
		
	}
}