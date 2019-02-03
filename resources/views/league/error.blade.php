@extends('master')

@section('body')
    @include('layout.title', ['name' => $league->name])
    
    <div class="flex flex-col">
        <div class="text-center p-4">
            Error!
        </div>
    </div>
@endsection