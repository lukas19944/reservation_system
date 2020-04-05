@extends('layouts.layout')
@section('title','Dodawanie stanowiska')
@section('content')
    <div class="choose-info">
        <h2>Dodaj stanowisko</h2>
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
        <form action="{{route('workplace.store')}}" method="post">

            <div class="form-inline">
            <label for="number">Numer stanowiska:</label>
            <input type="text" name="number" id="number">
            </div>
            <div class="form-inline">
            <label for="description"> Opis stanowiska:</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            @csrf
            <button type="submit" class="btn float-right">Dodaj</button>
        </form>
    </div>
@endsection
