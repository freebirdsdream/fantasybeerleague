@extends('master')

@section('body')
	<div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>{{ $league->name }} Season {{ $season->number }}</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <h4>Groups</h3>
            <div style="padding-top: 5px;">
            	@if(!$season->groups->count())
                    You don't currently have any members of the league, send some invites!
                @else
                    @foreach($season->groups as $group)
                        <ul>
                            <li><a href="{{ route('group.show', ['id' => $group->id]) }}">{{ $group->name }}</a>
                        </ul>
                    @endforeach
                @endif
            </div>

            <div style="padding-top: 15px;">
                <a href="{{ route('group.edit', ['season' => $season]) }}">Organize Groups</a>
            </div>

            <div style="padding-top: 15px;">
                @if($season->groups->count() && !$season->drafted && !$season->draft)
                    <a href="/draft/create?season_id={{ $season->id }}" class=bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" >Create Draft</a>
                @elseif($season->draft)
                    <a href="/draft/{{ $season->draft->first()->id }}">View Draft</a>
                @endif
            </div>

            <div style="padding-top:15px;">
                <form action="{{ route('group.store') }}" method="POST">
                    <div class="mb-4">
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="group" type="text" name="name" placeholder="Group">
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="season_id" value="{{ $season->id }}" />
                        {{ csrf_field() }}
                        <input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Create Group" />
                    </div>
                </form>
            </div>
 
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection