@extends('master')

@section('body')
    <div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>{{ $league->name }} Season {{ $season->number }} Group {{ $group->name }}</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <h4>Tasting Events</h3>
            <div style="padding-top: 5px;">
                @if(!$group->events->count())
                    You don't currently have any events, create one!
                @else
                    @foreach($group->events as $event)
                        <ul>
                            <li><a href="{{ route('event.show', ['id' => $event->id]) }}">{{ $event->name }}</a></li>
                        </ul>
                    @endforeach
                @endif
            </div>
            <div style="padding-top:15px;">
                <a href="{{ route('event.create') }}?group_id={{ $group->id }}" class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">Create Tasting Event</a>
            </div>
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection