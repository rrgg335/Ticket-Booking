<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\{Booking,User};
use App\Http\Requests\{ConfirmBookingRequest,CreateBookingRequest};// For validation
use Exception,Log;
class BookingsController extends Controller{
	public function __construct(){}
	public function create(CreateBookingRequest $request):JsonResponse{
		$seat_no = $request->validated('seat_no');
		$no_of_seats = $request->validated('no_of_seats');
		$seats_to_book = $this->checkAvailability($seat_no,$no_of_seats);
		if(!empty($seats_to_book)){
			return response()->success([
				'availability'=>true,
				'seats'=>$seats_to_book
			]);
		}else{
			return response()->success([
				'availability'=>false,
				'message'=>'Your requested seats are not available'
			]);
		}
	}
	public function confirm(ConfirmBookingRequest $request):JsonResponse{
		$seats = $request->validated('seats');
		if(!Booking::whereIn('seat_no',$seats)->exists()){
			foreach($seats as $seat){
				Booking::create([
					'user_id'=>$request->user()->id,
					'seat_no'=>$seat
				]);
			}
			return response()->success([
				'message'=>'Seats booked successfully'
			]);
		}else{
			return response()->success([
				'message'=>'Someone else grabbed those seats first. Please select again.'
			]);
		}
	}
	private function checkAvailability($seat_no,$no_of_seats):array{
		$seats_to_book = [];
		$column_number = substr($seat_no,0,1);
		$row_number = intval(substr($seat_no,1));
		for($i=min(10,$row_number + ($no_of_seats - 1));$i>=max(0,$row_number - ($no_of_seats - 1));$i--){
			if(!Booking::where('seat_no',$column_number.$i)->exists()){
				$seats_to_book[] = $column_number.$i;
			}
			if(count($seats_to_book) >= $no_of_seats){
				break;
			}
		}
		if(count($seats_to_book) >= $no_of_seats){
			usort($seats_to_book,function($seat_1,$seat_2){
				if($seat_1 == $seat_2){
					return 0;
				}
				return (intval(substr($seat_1,1)) < intval(substr($seat_2,1))) ? -1 : 1;
			});
			return $seats_to_book;
		}else{
			return [];
		}
	}
}