<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Response;
class ResponseServiceProvider extends ServiceProvider{
	public function register(){}
	public function boot(){
		Response::macro('success',function(mixed $json_data=[],int $statuscode=200,array $headers=[],int $options=0){
			$json_data = array_merge(['success'=>true],$json_data);
			if(app()->environment('local')){
				$options = $options | JSON_PRETTY_PRINT;
			}
			return Response::json($json_data,$statuscode,$headers,$options);
		});
		Response::macro('error',function(mixed $json_data=[],int $statuscode=400,array $headers=[],int $options=0){
			$json_data = array_merge(['success'=>false],$json_data);
			if(app()->environment('local')){
				$options = $options | JSON_PRETTY_PRINT;
			}
			return Response::json($json_data,$statuscode,$headers,$options);
		});
	}
}