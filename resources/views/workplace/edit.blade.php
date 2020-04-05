@extends('layouts.layout')
@section('title','Wybór stanowiska')
@section('content')

    <div class="choose-info">
        <h2>Edytuj stanowisko</h2>
        <form action="{{route('workplace.destroy', $workplace)}}" method="post">
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
    <div class="main">
        <div class="add-workplace">
            <form action="{{route('workplace.update', $workplace)}}" method="post">
                @method('PUT')

                <div class="form-inline">
                    <label for="description"> Opis stanowiska:</label>
                    <textarea name="description" id="description" cols="30" rows="10">{{$workplace->description}}</textarea>
                </div>
                <div class="form-inline">
                    <div class="form-label">
                        <label for="equipments">Dodaj wyposażenie</label>
                    </div>
                    <div class="form-column">
                        <select name="equipments[]" class="equipments" >
                            <option value="">
                                Wybierz wyposażenie z listy...
                            </option>
                            @foreach($equipments as $equipment)
                                <option value="{{$equipment->id}}">

                                    {{$equipment->designation}}. {{$equipment->type}} - {{$equipment->model}}

                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                @csrf
                <button type="submit" class="btn float-right">Zapisz</button>
            </form>
            <button class="btn add-select">Dodaj kolejne</button>
        </div>
        <div class="equipments-list">
            <p>Lista wyposażenia:</p>
            <table>
                <tr>
                    <th>Oznaczenie</th>
                    <th>Typ</th>
                    <th>Model</th>
                    <th>Usuń z stanowiska</th>
                </tr>

                @foreach($workplace_equipments as $workplace_equipment)
                    <tr>
                        <td>{{$workplace_equipment->designation}}</td>
                        <td>{{$workplace_equipment->type}}</td>
                        <td>{{$workplace_equipment->model}}</td>
                        <td>
                            <button id="detach" class="btn danger" data-id="{{$workplace_equipment->id}}">Usuń</button>
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
    <script>

        window.addEventListener('DOMContentLoaded', ()=>{
            const equipments={!! json_encode($equipments) !!}
            const url="{{route('equipment.detach')}}"
            const token = "{{csrf_token()}}"

            const btn=document.querySelector('.add-select')
            const divSelect=document.querySelector('.equipments').parentElement;
            const detachBtn=document.querySelector('#detach');


            btn.addEventListener('click',addSelectOption);

        detachBtn.addEventListener('click',(e)=>{
            let id=e.target.dataset['id'];
            console.log(id)
            let result=detachEquipment(id);

            if (detachEquipment(id,e)){
                let tr=e.target.closest('tr');
                tr.remove();
            }
        });
        });
    </script>


@endsection
