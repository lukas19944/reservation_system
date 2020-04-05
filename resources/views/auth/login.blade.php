@extends('layouts.layout')

@section('content')
                <div class="login-container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-inline">
                            <label for="email" class="">{{ __('E-mail') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-inline">
                            <label for="password" class="">{{ __('Hasło') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>


                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        {{ __('Zapamietaj mnie') }}
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                </div>

                            <div class="float-right">
                                @if (Route::has('password.request'))
                                    <a class="btn" href="{{ route('password.request') }}">
                                        {{ __('Zapomniałes hasło?') }}
                                    </a>
                                @endif

                                    <button type="submit" class="btn ">
                                        {{ __('Zaloguj') }}
                                    </button>
                            </div>

                    </form>
                </div>
@endsection
