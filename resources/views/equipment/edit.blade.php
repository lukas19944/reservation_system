@extends('layouts.layout')
@section('title','Dodawanie stanowiska')
@section('content')
    <div class="choose-info">
        <h2>Edytuj wyposażenie</h2>
        <form action="{{route('equipment.destroy', $equipment)}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn danger">Usuń</button>
        </form>
    </div>
    <div class="error-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="add-workplace">
        <form action="{{route('equipment.update', $equipment)}}" method="post">
            @method('PUT')

            <div class="form-inline">
                <label for="type">Typ:</label>
                <input type="text" name="type" id="type" value="{{$equipment->type}}">
            </div>
            <div class="form-inline">
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" value="{{$equipment->model}}">
            </div>
            <div class="form-inline">
                <label for="buy_date">Rok zakupu:</label>
                <input type="text" name="buy_date" id="buy_date" value="{{$equipment->buy_date}}">
            </div>
            <div class="form-inline">
                <label for="price">Cena:</label>
                <input type="text" name="price" id="price" value="{{$equipment->price}}">
            </div>
            <div class="form-inline">
            <label for="description"> Opis stanowiska:</label>
            <textarea name="description" id="description" cols="30" rows="10">{{$equipment->description}}</textarea>
            </div>
            @csrf
            <button type="submit" class="btn float-right">Dodaj</button>
        </form>
    </div>
{{--    <script src="{{asset('js/main.js')}}"></script>--}}
@endsection
