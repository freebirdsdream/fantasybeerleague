@extends('master')

@section('body')
    @if($event)
        <div class="w-full max-w-xs mx-auto mt-6">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2>{{ $event->name }} Group {{  Auth::user()->tastingGroup->first()->name }}</h2>

                <br />

                @foreach($tastingGroups as $tastingGroup)
                    <div id="glasses">
                        @foreach($tastingGroup->players as $x => $player)
                            <div class="md:flex md:items-center mb-6 justify-between border rounded shadow-md p-4 cursor-pointer">
                                {{ $player->pivot->glass }}
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker ml-2 mr-2" placeholder="Notes" type="text" name="{{ $player->pivot->glass }}Notes" />
                                <i class="fa fa-beer fa-2x text-orange-light"></i>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker m-2">Pouring: {{ Auth::user()->tastingGroup->first()->pivot->glass }}</span>
                <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker m-2">Beer: Hidden</span>
            </form>
            <p class="text-center text-grey text-xs">
                ©2018 Acme Corp. All rights reserved.
            </p>
        </div>
    @else
        No tastings are currently happening.
    @endif

    <script type="text/javascript">
        dragula([document.querySelector('#glasses')]);
    </script>
@endsection