<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $fillable=['number', 'description'];

    public function equipments(){
        return $this->hasMany('App\Equipment');
    }
    public function reservations(){
        return $this->hasMany('App\Reservation');

    }
}
