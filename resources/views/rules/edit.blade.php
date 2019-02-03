@extends('master')

@section('body')
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2>Rules</h2>

        <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                <i class="fa fa-beer fa-4x"></i>
        </div>

        <p>
        	<form action="{{ route('rules.update', $league) }}" method="POST">
		        @include('assets.input.textarea', ['name' => 'text', 'placeholder' => 'Rules', 'text' => $rules->text])

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                
			    @include('assets.input.submit', ['name' => 'Save'])
			</form>
        </p>
    </div>
@endsection