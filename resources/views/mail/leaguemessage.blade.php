@extends('master')

@section('body')
    @include('layout.title', ['name' => $league->name])
    
    <div class="flex flex-col">
        <div class="text-left p-4">
            {{ $text }}
        </div>
        @if($rules)
        <hr />
        <div class="p-4 text-left">
        	{!! Markdown::convertToHtml($rules->text) !!}
        </div>
        @endif
    </div>
    <div class="p-4">
    	{{ $user->name }}
    </div>
@endsection