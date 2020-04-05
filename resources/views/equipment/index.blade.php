@extends('layouts.layout')
@section('title','Wybór stanowiska')
@section('content')
    <div class="choose-info">
        <h2>Wybierz wyposażenie aby je zmodyfikować</h2>
        <a href="{{route('equipment.create')}}">Dodaj wyposażenie</a>
    </div>

    <div class="workplaces-list">
        <ul>
            @foreach($equipments as $equipment)
                <li><a href="{{route('equipment.edit', $equipment)}}"><span class="number">{{$equipment->designation}}.</span> {{$equipment->type}} - {{$equipment->model}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
