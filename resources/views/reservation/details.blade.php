@extends('layouts.layout');
@section('title','Tworzenie rezerwacji');

@section('content')
    <div class="choose-info">
        <h2>Stwórz rezerwacje</h2>
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
            <h3>Szczegóły stanowiska</h3>
            <p>Opis: {{$workplace->description}}</p>
            <p>Numer stanowiska: {{$workplace->number}}</p>

        </div>
            <div class="equipments-table">
                <p><b>Lista wyposażenia:</b></p>
                <table>
                    <thead>
                        <th>Oznaczenie</th>
                        <th>Typ:</th>
                        <th>Model</th>
                        <th>Data zakupu</th>
                        <th>Cena</th>
                    </thead>
                    @foreach($workplace->equipments as $equipment)
                    <tr>
                        <td>{{$equipment->designation}}</td>
                        <td>{{$equipment->type}}</td>
                        <td>{{$equipment->model}}</td>
                        <td>{{$equipment->buy_date}}</td>
                        <td>{{$equipment->price}}</td>
                    </tr>


                    @endforeach
                </table>
            </div>

    </div>
    <div class="error-message"><p></p></div>
    <div class="workplace">
        <div class="add-workplace">
    {{--        <form action="{{route('reservation.make', $workplace)}}" method="post">--}}

                <div class="form-inline">
                    <label for="name">Imie:</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="form-inline">
                    <label for="surname">Nazwisko:</label>
                    <input type="text" name="surname" id="surname">
                </div>
                <div class="form-inline">
                    <label for="phone_number">Numer telefonu:</label>
                    <input type="text" name="phone_number" id="phone_number">
                </div>
                <div class="form-inline">
                    <label for="mail">E-mail:</label>
                    <input type="email" name="mail" id="mail">
                </div>
                <div class="form-inline">
                    <label for="description">Opis:</label>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
                </div>
                <div class="form-inline">
                    <label for="date">Data:</label>
                    <input type="date" name="date" id="date">
                </div>
                <div class="form-inline">
                    <label for="from_hours">Od:</label>
                    <select name="from_hours" id="from_hours" class="hours">
                        <option value="">Wybierz godzinę</option>
                    </select>
                </div>
                <div class="form-inline">
                    <label for="to_hours">Do:</label>
                    <select name="to_hours" id="to_hours" class="hours">
                        <option value="">Wybierz godzinę</option>
                    </select>
                </div>

                @csrf
                <button class="btn float-right" id="reserv">Dodaj</button>
    {{--        </form>--}}

        </div>

        <div class="response">
            <p></p>
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
    <script>

        const url="{{route('reservation.make',$workplace)}}"
        const fetch_reservation_of_day_url="{{route('reservation.fetch_reservation_of_day',$workplace)}}"
        const workplace_id="{{$workplace->id}}";
        const token="{{csrf_token()}}"

        window.addEventListener('DOMContentLoaded',()=>{

            append_hours_option();

            const btn=document.querySelector('#reserv');
            const name=document.querySelector('#name');
            const surname=document.querySelector('#surname');
            const telephone_number=document.querySelector('#phone_number');
            const mail=document.querySelector('#mail');
            const description=document.querySelector('#description');
            const date=document.querySelector('#date');
            const from_hours=document.querySelector('#from_hours');
            const to_hours=document.querySelector('#to_hours');


            // console.log(response_div);
            btn.addEventListener('click',()=>{
                check_reservation(workplace_id, name.value, surname.value, telephone_number.value,
                    mail.value, description.value,date.value,parseInt(from_hours.value),parseInt(to_hours.value));
            });
            date.addEventListener('change',()=>{
                list_reservation_of_day(workplace_id, date.value);
            });

        });

    </script>

@endsection
