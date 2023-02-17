<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{

    public function test_example(): void
    {
        $signin_request = $this->call('post','api/signin',[
            'email'=>'test@example.com',
            'password'=>'12345678'
        ]);
        $response_json = json_decode($signin_request->getContent(),true);
        if(empty($response_json['success'])){
            $this->assertTrue(!empty($response_json['success']));
        }
        if(!empty($response_json['token'])){
            $user_token = $response_json['token'];
            $booking_request = $this->call('post','api/bookings/check',[
                'seat_no'=>'A4',
                'no_of_seats'=>'3'
            ],[
                'Authorization'=>'Bearer '.$user_token
            ]);
            $booking_request->assertStatus(200);
        }
    }
}
