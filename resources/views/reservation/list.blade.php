@extends('layouts.layout')
@section('title', 'Lista rezerwacji')

@section('content')
    <div class="choose-info">
        <h2>Wybierz stanowisko</h2>
    </div>

    <div class="workplaces-list">
        <ul>
            @foreach($reservations as $reservation)
                <li><a href="{{route('reservation.show', $reservation)}}"><span class="number">{{$reservation->id}}.</span> {{$reservation->date}} Od {{$reservation->from_hours}} do {{$reservation->to_hours}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
