@extends('layouts.layout')
@section('title','Wybór stanowiska')
@section('content')
    <div class="choose-info">
        <h2>Wybierz stanowisko aby je zmodyfikować</h2>
        <a href="{{route('workplace.create')}}">Dodaj stanowisko</a>
    </div>

    <div class="workplaces-list">
        <ul>
            @foreach($workplaces as $workplace)
                <li><a href="{{route('workplace.edit', $workplace)}}"><span class="number">{{$workplace->number}}.</span> {{$workplace->description}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
