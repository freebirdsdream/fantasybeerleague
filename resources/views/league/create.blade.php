@extends('master')

@section('body')
    <div class="w-5/6 m-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
            @include('layout.title', ['name' => 'Create League'])
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
@endsection