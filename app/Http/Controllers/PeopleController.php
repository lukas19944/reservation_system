<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public static function add($people_details){

        $people=People::create($people_details);

        return $people;
    }
}
