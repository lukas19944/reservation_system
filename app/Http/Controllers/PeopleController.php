<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public static function add($people_details){
        try {
            $people = People::create($people_details);
        }catch (\Exception $e){
            abort(500,$e->getMessage());
        }

        return $people;
    }
}
