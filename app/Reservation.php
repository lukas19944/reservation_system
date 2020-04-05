<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable=['people_id','workplace_id','date','from_hours', 'to_hours'];

    public function workplace(){
        return $this->belongsTo('App\Workplace');

    }
    public function people(){
        return $this->belongsTo('App\People');

    }

}
