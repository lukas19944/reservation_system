@extends('layouts.layout');
@section('title','Tworzenie rezerwacji');

@section('content')
    <div class="choose-info">
        <h2>Szczegóły rezerwacji</h2>
        <form action="{{route('reservation.destroy', $reservation)}}" method="post">
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
    <div class="workplace">
        <div class="workplace-details">
            <h3>Zarezerwowane przez:</h3>
            <p>Imię i nazwisko: {{$reservation->people->name}} {{$reservation->people->surname}}</p>
            <p>Numer telefonu: {{$reservation->people->phone_number}}</p>
            <p>E-mail: {{$reservation->people->mail}}</p>
            <p>Opis: {{$reservation->people->description}}</p>

        </div>
        <div class="equipments-table">
            <p><b>Lista wyposażenia:</b></p>
            <table>
                <thead>
                <th>Data rezerwacji</th>
                <th>Godzina rozpoczęcia</th>
                <th>Godzina zakończenia</th>

                </thead>

                    <tr>
                        <td>{{$reservation->date}}</td>
                        <td>{{$reservation->from_hours}}</td>
                        <td>{{$reservation->to_hours}}</td>

                    </tr>



            </table>
        </div>

    </div>


    <script src="{{asset('js/main.js')}}"></script>
    <script>append_hours_option();</script>
@endsection
