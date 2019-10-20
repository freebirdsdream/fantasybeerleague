@extends('master')

@section('body')
    @include('layout.header', ['name' => 'Manage League'])

    <div class="w-5/6 m-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6">
        <p>
        	<form action="{{ route('league.update', $league) }}" method="POST">
		        @include('assets.input.text', ['name' => 'name', 'placeholder' => 'League Name', 'value' => $league->name])
                @include('assets.input.text', ['name' => 'location', 'placeholder' => 'Location', 'value' => $league->location])
                @include('assets.input.text', ['name' => 'description', 'placeholder' => 'Description', 'value' => $league->description])

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                
			    @include('assets.input.submit', ['name' => 'Save'])
			</form>
        </p>
        <div class="bg-white shadow-md px-8 pt-6 pb-8 mb-4 bg-red-lightest border-l-4 border-red text-red-dark">
        <h2>Danger Zone!</h2>
        <form class="mt-4" action="{{ route('league.destroy', $league) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
            <input type="submit" value="Delete League" class="bg-white hover:bg-red text-red-dark font-semibold hover:text-white py-2 px-4 border border-red hover:border-transparent rounded cursor-pointer no-underline" href="{{ route('league.destroy', $league) }}" />
        </form>
    </div>
    </div>
@endsection