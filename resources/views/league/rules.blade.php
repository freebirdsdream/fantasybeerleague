@extends('master')

@section('body')
    <img class="w-full rounded-t" src="https://craftbeerclub.com/media/gm/user/gmwc/img_cbc/craft-beer-club-beer-flight.jpg" alt="Sunset in the mountains">
	@include('layout.title', ['name' => $league->name])

    
@endsection