<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table='equipments';
    protected $fillable=['type','model','designation','buy_date','price','description','workplace_id'];

    public function workplaces(){
        return $this->belongsTo('App\Workplace');
    }

}
