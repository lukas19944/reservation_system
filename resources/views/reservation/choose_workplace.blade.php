@extends('layouts.layout')
@section('title', 'Rezerwacja')

@section('content')
    <div class="choose-info">
        <h2>Wybierz stanowisko</h2>
    </div>

    <div class="workplaces-list">
        <ul>
            @foreach($workplaces as $workplace)
                <li><a href="{{route('reservation.details', $workplace)}}"><span class="number">{{$workplace->number}}.</span> {{$workplace->description}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
