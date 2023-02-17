<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash,Str;
class UserSeeder extends Seeder{
	public static function run(){
		$user = User::where('email','test@example.com')->first();
		if(empty($user)){
			$user = User::create([
				'name'=>'John Doe',
				'email'=>'test@example.com',
				'password'=>Hash::make('12345678')
			]);
		}
	}
}