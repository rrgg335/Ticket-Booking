<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model{
	protected $table = 'bookings';
	protected $primaryKey = 'id';
	protected $hidden = [];
	public $timestamps = true;
	protected $guarded = [];
}