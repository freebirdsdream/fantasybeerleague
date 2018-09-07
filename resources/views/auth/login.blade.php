@extends('master')

@section('body')
    <div class="w-full max-w-xs mx-auto mt-6">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" name="email" type="text" placeholder="yourname@email.com">

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3" name="password" id="password" type="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">
                    Sign In
                </button>
                <div class="flex flex-col">
                    <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                    <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>
        </form>
        <p class="text-center text-grey text-xs">
            ©2018 FBL LLC. All rights reserved.
        </p>
    </div>
@endsection
