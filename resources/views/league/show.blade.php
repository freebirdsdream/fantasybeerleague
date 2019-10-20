@extends('master')

@section('body')
    <div class="w-full mt-0">
        @include('layout.header', ['name' => $league->name])

        <div class="px-8 pb-4 w-5/6 m-auto mt-6">
            <div class="w-full lg:flex">
                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ asset('images/braggot.jpg') }}')" title="Beer">
                </div>
                <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                    <div clss="mb-8">
                        <div class="text-black font-bold text-xl mb-2">Description</div>
                        <p>
                            {{ $league->description }}
                        </p>
                        <p class="pt-4">
                            <a class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded cursor-pointer no-underline mr-4" href="{{ route('rules.show', $league) }}">View Rules</a>
                        </p>
                    </div>
                    @can('update', $league)
                        <div class="w-full mt-4">
                            <div class="text-black font-bold text-xl mb-2">Admin</div>
                            <div class="flex justify-start w-full">
                                <a class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded cursor-pointer no-underline mr-4" href="{{ route('league.edit', $league) }}">Edit League</a>
                                <a class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded cursor-pointer no-underline mr-4" href="{{ route('rules.edit', $league) }}">Edit Rules</a>
                                <a class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded cursor-pointer no-underline" href="{{ route('leaguemessage.edit', $league) }}">Message Members</a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="mt-8 mb-8 w-full lg:flex">
                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://www.recorder.com/getattachment/4706aa44-1488-4721-8219-2f5eb7b58645/AC-calendar-122018-ph01')" title="Woman holding a mug">
                </div>
                <div class="w-full border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <div class="text-black font-bold text-xl mb-2">Seasons</div>
                        <p class="text-grey-darker text-base">
                            @if(!$league->seasons->count())
                                You don't have any seasons, create one now!
                        @else
                            @foreach($league->seasons as $season)
                                @if($season->complete)
                                    <div class="shadow-md p-4 hover:bg-yellow text-yellow-darker mb-2">
                                        {{ $season->number }}
                                    </div>
                                @else
                                    <div class="shadow-md p-4 cursor-pointer hover:bg-yellow text-yellow-darker mb-2">
                                        <a class="no-underline text-grey-darkest group-hover:text-yellow-darker" href="{{ route('season.show', ['id' => $season->id]) }}">
                                            {{ $season->number }}
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                    </p>
                    </div>
                    <div class="flex items-center">
                        <form action="{{ route('season.create') }}" method="GET">
                            <div class="mb-4">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                <input type="hidden" name="league_id" value="{{ $league->id }}" />
                                {{ csrf_field() }}
                                <input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Create New Season" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full lg:flex">
                <div class="border border-grey-light lg:border-grey-light bg-white rounded p-4 flex flex-col justify-between leading-normal w-full">
                    <div class="mb-8">
                        <div class="text-black font-bold text-xl mb-4">Members</div>
                        <p class="text-grey-darker text-base w-full">
                            @if(!$league->members->count())
                                You don't currently have any members of the league, send some invites!
                            @else
                                @foreach($league->members as $member)
                                    @include('layout.usercard', ['user' => $member, 'league' => $league])
                                @endforeach
                            @endif
                        </p>
                    </div>
                    @can('update', $league)
                        <div class="w-full mt-4">
                            @if($league->invitations)
                                <div class="text-black font-bold text-xl mb-2">Outstanding Invitations</div>
                                <div class="flex flex-col">
                                    @foreach($league->invitations as $invitation)
                                        <a href="http://beerleague.test/leagueuser/{{ $league->id }}?email={{ urlencode($invitation->email) }}&invitation={{ $invitation->id }}">http://beerleague.test/leagueuser/{{ $league->id }}?email={{ urlencode($invitation->email) }}&invitation={{ $invitation->id }}</a>
                                    @endforeach
                                </div>
                            @endif
                            <div class="text-black font-bold text-xl mb-2">Invite Members</div>
                            <form class="w-full flex flex-row" action="{{ route('leagueinvitation.store') }}" method="POST">
                                <div class="w-3/4">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" name="email" placeholder="Email">
                                </div>
                                <div class="ml-4 w-1/4">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                    <input type="hidden" name="league_id" value="{{ $league->id }}" />
                                    {{ csrf_field() }}
                                    <input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded w-full" type="submit" value="Send Invitation" />
                                </div>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection