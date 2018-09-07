@extends('master')

@section('body')
    <div class="w-full max-w-xs mx-auto mt-6">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-grey-darker text-sm font-bold mb-2">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-grey-darker text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="password_confirmation" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="flex items-center justify-between">
                    <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection
