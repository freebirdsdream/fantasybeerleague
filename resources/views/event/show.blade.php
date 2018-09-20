@extends('master')

@section('body')
    <div class="container mx-auto pt-8 pb-8">
        <div class="header">
            <h2>{{ $event->name }} Week</h2>
        </div>

        <div class="scores container">
            @foreach($tastingGroups as $tastingGroup)
                @include('event.scorecard', ['scores' => $tastingGroup->scores, 'tastingGroup' => $tastingGroup])
            @endforeach
        </div>
    </div>
@endsection