
    <nav>
        <ul>
            <li class="nav-li"><a href="{{route('home')}}">Home</a></li>
            <li class="nav-li"><a href="{{route('reservation')}}">Rezerwacja </a></li>
            @auth()
                <li class="nav-li"><a href="{{route('workplace.index')}}">Zarządzanie stanowiskami</a></li>
                <li class="nav-li"><a href="{{route('equipment.index')}}">Wyposażenie</a></li><li class="nav-li"><a href="{{route('reservation.list')}}">Lista rezerwacji </a></li>
                <li class="nav-li"><a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Wyloguj się
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth

            @guest()
            <li class="nav-li"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
            @endguest

        </ul>
    </nav>

