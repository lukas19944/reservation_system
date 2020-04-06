<?php

namespace App\Http\Controllers;

use App\People;
use App\Reservation;
use App\Workplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only'=>['list','show','destroy']]);
    }

    public function list(){
        $reservations=Reservation::all()->sortByDesc('created_at');

        foreach ($reservations as $reservation){
            $reservation->to_hours=$reservation->to_hours+0.1;
        }

        return view('reservation.list')->with('reservations',$reservations);

    }
//      Display a list of the workplaces to reservation.

    public function choose_workplace()
    {
        $workplaces=Workplace::all();

        return view('reservation.choose_workplace')->with('workplaces', $workplaces);
    }

//      Enter details of the reservation
    public function reservation(Workplace $workplace)
    {

        return view('reservation.details')->with('workplace', $workplace);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function make(Request $request, Workplace $workplace)
    {
        $to_hours=$request->to_hours-0.1;
//        Check if reservation is taken

        $reservation=self::check_reservation($request->workplace_id,$request->date,$request->from_hours,$to_hours);

        if ($reservation!==null) {
            return 'Rezerwacja w tych godzinach jest już niedostępna';
        }

//          Add reservation
        try{
            $people=PeopleController::add($request->only('name','surname','phone_number','mail','description'));

            $reservation = Reservation::create(['people_id' => $people->id, 'workplace_id' => $request->workplace_id,
                'date' => $request->date, 'from_hours' => $request->from_hours, 'to_hours' => $to_hours]);

            return "Stanowisko zostało zarezerwowane";
        }catch (\Exception $e){
            abort(500,$e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {

        return view('reservation.show')->with('reservation', $reservation);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->people()->delete();
            $reservation->delete();
        }catch (\Exception $e){
            abort(500,$e->getMessage());
        }

        redirect(route('reservation.list'));
    }
    public static function check_reservation($workplace_id,$date, $from_hours, $to_hours){

        $new_to_hours=$to_hours-0.1;
        $reservation=Reservation::where("date",$date)
            ->where("workplace_id",$workplace_id)
            ->whereRaw("(? >= from_hours AND ? <= to_hours OR ? >= from_hours AND ? <= to_hours OR to_hours BETWEEN ? AND ?)",
                [$from_hours, $from_hours,$new_to_hours, $new_to_hours,$from_hours,$to_hours])
            ->first();

        return $reservation;

    }
    public function fetch_reservation_of_day(Request $request, Workplace $workplace){
        Log::info($request);
        $reservation=Reservation::where('workplace_id', $workplace->id)
            ->where('date',$request->date)
            ->get();
        echo json_encode($reservation);
    }
}
