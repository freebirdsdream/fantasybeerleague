@extends('master')

@section('body')
	<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
	    @include('layout.title', ['name' => 'Message to ' . $league->name])
	    
	    <p>
	    	<form action="{{ route('leaguemessage.update', $league) }}" method="POST">
	    		<input class="mb-4" type="checkbox" name="rules" /> Include Rules
	    		@include('assets.input.text', ['name' => 'subject', 'placeholder' => 'Subject'])
		        @include('assets.input.textarea', ['name' => 'text', 'placeholder' => 'Message', 'text' => 'Write your email here (Markup supported)'])

	            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
	            <input type="hidden" name="_method" value="PUT">
	            {{ csrf_field() }}

			    <div class="flex flex-row justify-between flex-wrap mb-4">
			    	<div class="w-1/5 no-overflow">
			    		<input type="checkbox" name="all_users" checked /> All Users
			    	</div>
			    	@foreach($league->members as $member)
			    		<div class="w-1/5 whitespace-no-wrap">
			    			<input type="checkbox" name="recipients[]" value="{{ $member->id }}" /> {{ $member->name }}
			    		</div>
			    	@endforeach
			    </div>

			    @include('assets.input.submit', ['name' => 'Send Message'])
			</form>
	    </p>
	</div>
@endsection