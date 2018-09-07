@extends('master')

@section('body')
	<div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>{{ $league->name }}</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <h4>Members</h3>
            <div style="padding-top: 5px;">
            	@if(!$league->members->count())
                    You don't currently have any members of the league, send some invites!
                @else
                    <ul>
                    @foreach($league->members as $member)
                        <li>
                            <a href="#">{{ $member->name }}</a>
                            @if($league->owner(Auth::user()) && Auth::user()->can('update', $league) && !$member->can('update', $league))
                                <form action="{{ route('user.update', ['user' => $member->id]) }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="role-name" value="admin" />
                                    <input type="hidden" name="role-target" value="{{ $league->id }}" />
                                    <input type="submit" value="Make Admin" />
                                </form>
                            @elseif($member->can('update', $league))
                                ADMIN
                            @endif
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>
            <div style="padding-top:15px;">
                <form action="{{ route('invitation.store') }}" method="POST">
                    <div class="mb-4">
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="league_id" value="{{ $league->id }}" />
                        {{ csrf_field() }}
                        <input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Send Invitation" />
                    </div>
                </form>
            </div>

            <h4 style="padding-top: 30px;">Seasons</h3>
            <div>
                @if(!$league->seasons->count())
                    You don't have any seasons, create one now!
                @else
                    @foreach($league->seasons as $season)
                        <ul>
                            <li><a href="{{ route('season.show', ['id' => $season->id]) }}">{{ $season->number }}</a>
                        </ul>
                    @endforeach
                @endif
                <form action="{{ route('season.store') }}" method="POST">
                    <div class="mb-4">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="league_id" value="{{ $league->id }}" />
                        {{ csrf_field() }}
                        <input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Create New Season" />
                    </div>
                </form>
            </div>
            
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection