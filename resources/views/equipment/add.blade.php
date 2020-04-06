@extends('layouts.layout')
@section('title','Dodawanie stanowiska')
@section('content')
    <div class="choose-info">
        <h2>Dodaj wyposażenie</h2>
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
        <form action="{{route('equipment.store')}}" method="post">

            <div class="form-inline">
                <label for="designation">Oznaczenie:</label>
                <input type="text" name="designation" id="designation">
            </div>
            <div class="form-inline">
                <label for="type">Typ:</label>
                <input type="text" name="type" id="type">
            </div>
            <div class="form-inline">
                <label for="model">Model:</label>
                <input type="text" name="model" id="model">
            </div>
            <div class="form-inline">
                <label for="buy_date">Rok zakupu:</label>
                <input type="text" name="buy_date" id="buy_date">
            </div>
            <div class="form-inline">
                <label for="price">Cena:</label>
                <input type="text" name="price" id="price">
            </div>
            <div class="form-inline">
            <label for="description"> Opis:</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            @csrf
            <button type="submit" class="btn float-right">Dodaj</button>
        </form>
    </div>
@endsection
