<?php

namespace App\Http\Controllers;

use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EquipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments=Equipment::all();
        return view('equipment.index')->with('equipments',$equipments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipment.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'designation'=>'required|integer|unique:equipments,designation',
            'type'=>'string',
            'model'=>'string',
            'buy_date'=>'date_format:Y',
            'price'=>'integer',
            'description'=>'string'

        ];

            $messages=[
                'required' => 'Wprowadź wszystkie dane!.',
                'string'=> 'Wprowadzono niepoprawne dane!',
                'unique'=> 'Stanowisko o takim numerze juz istnieje!'
            ];
        $this->validate($request,$rules,$messages);


        return redirect(route('equipment.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {

        return view('equipment.edit')->with('equipment',$equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {

        $rules=[
            'type'=>'string',
            'model'=>'string',
            'buy_date'=>'date_format:Y',
            'price'=>'integer',
            'description'=>'string'

        ];

        $messages=[
            'required' => "Wprowadź wszystkie dane!. :attribute",
            'string'=> 'Wprowadzono niepoprawne dane!',
            'unique'=> 'Stanowisko o takim numerze juz istnieje!'
        ];
        $this->validate($request,$rules,$messages);

        $equipment->update($request->all());

        return redirect(route('equipment.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
    }

    public function detach(Request $request){
        $equipment=Equipment::where('id',$request->id)->first();
        $equipment->update(['workplace_id'=>null]);

    }

}
