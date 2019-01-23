@extends('master')

@section('body')
	<div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>Create League</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <p>
            	<form action="{{ route('league.store') }}" method="POST">
			        @include('assets.input.text', ['name' => 'name', 'placeholder' => 'League Name'])
                    @include('assets.input.text', ['name' => 'location', 'placeholder' => 'Location'])
                    @include('assets.input.text', ['name' => 'description', 'placeholder' => 'Description'])

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                    {{ csrf_field() }}
                    
				    @include('assets.input.submit', ['name' => 'Create'])
				</form>
            </p>
            
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection