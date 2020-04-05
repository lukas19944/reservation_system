<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable=['name','surname','phone_number','mail','description'];
    protected $table='peoples';

    public function reservations(){
        return $this->hasMany('App\Reservation');

    }

}
