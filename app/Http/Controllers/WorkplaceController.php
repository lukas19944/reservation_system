<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Workplace;
use Illuminate\Http\Request;

class WorkplaceController extends Controller
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
        $workplaces=Workplace::all();

        return view('workplace.index')->with('workplaces',$workplaces);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workplace.add');
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
            'number'=>'integer|unique:workplaces,number',
            'description'=>'required|string'
        ];
        $messages=[
            'required' => 'Wprowadź wszystkie dane!.',
            'string'=> 'Wprowadzono niepoprawne dane!',
            'unique'=> 'Stanowisko o takim numerze juz istnieje!'
        ];
        $this->validate($request,$rules,$messages);

        try {
            $workplace = Workplace::create($request->only('number', 'description'));
        }catch (\Exception $e){
            abort(500,$e->getMessage());
        }

        return redirect(route('workplace.index'));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function edit(Workplace $workplace)
    {
        try {
            $equipments = Equipment::all();
            $workplace_equipments = $workplace->equipments()->get();
        }catch (\Exception $e){
            abort(500,$e->getMessage());
        }



        return view('workplace.edit')->with('workplace',$workplace)
                                           ->with('equipments',$equipments)
                                           ->with('workplace_equipments',$workplace_equipments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workplace $workplace)
    {
        $rules=[

            'description'=>'required|string',
            'equipments'=>'required|array',
            'equipments.*'=>'required',
        ];
        $messages=[
            'required' => 'Wprowadź wszystkie dane!.',
            'string'=> 'Wprowadzono niepoprawne dane!',
            'unique'=> 'Stanowisko o takim numerze juz istnieje!'
        ];

        $this->validate($request,$rules,$messages);
        try {
            $workplace->update($request->only(['description']));
            foreach ($request->equipments as $equipment) {

                $current_equipment = Equipment::where('id', $equipment)->first();
                $current_equipment->update(['workplace_id' => $workplace->id]);
            }
        }catch (\Exception $e){
            abort(500,$e->getMessage());
        }
        return redirect(route('workplace.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workplace $workplace)
    {
        try {
            $workplace->equipments()->update(['workplace_id' => null]);
            $workplace->delete();
        }catch (\Exception $e){
            abort(500,$e->getMessage());
        }
        return redirect(route('workplace.index'));
    }
}
