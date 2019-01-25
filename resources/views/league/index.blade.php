@extends('master')

@section('body')
    @include('layout.title', ['name' => 'Leagues'])
    @if(!$leagues)
        You aren't a part of any leagues right now.
    @else
        <div class="flex flex-col justify-center content-center items-center mb-4">
            <div class="max-w-sm rounded overflow-hidden shadow-lg mb-4">
              <img class="w-full rounded" src="https://craftbeerclub.com/media/gm/user/gmwc/img_cbc/craft-beer-club-beer-flight.jpg" alt="Sunset in the mountains">
              <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6">Leagues You Own</div>
                <p class="text-grey-darker">
                    @if(@$leagues->where('created_by', Auth::user()->id)->count())
                        @foreach($leagues->where('created_by', Auth::user()->id) as $league)
                            <div class="shadow-md p-4 cursor-pointer hover:bg-yellow text-yellow-darker mb-2 flex flex-row justify-between items-center">
                                <a class="no-underline text-grey-darkest group-hover:text-yellow-darker" href="/league/{{ $league->id }}">
                                    {{ $league->name}}
                                </a>
                                @if(Auth::user()->can('update', $league))
                                    <a href="{{ route('league.edit', $league) }}" class="bg-white hover:bg-yellow text-yellow-dark font-semibold hover:text-white py-2 px-4 border border-yellow-dark hover:border-white rounded" style="text-decoration: none;">
                                        Edit League
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="mb-2 text-grey-darker">You aren't currently running any leagues.</div>
                    @endif
                </p>
              </div>
            </div>

            <div class="max-w-sm rounded overflow-hidden shadow-lg">
              <img class="w-full" src="https://blog.edx.org/wp-content/uploads/2018/04/blog-hero.jpg" alt="Sunset in the mountains">
              <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6">Leagues I'm In</div>
                <p class="text-grey-darker">
                    @if($leagues->whereNotIn('created_by', [Auth::user()->id])->count())
                        @foreach($leagues->whereNotIn('created_by', [Auth::user()->id]) as $league)
                            <div class="shadow-md p-4 cursor-pointer hover:bg-yellow text-yellow-darker">
                                <a class="no-underline text-grey-darkest group-hover:text-yellow-darker" href="/league/{{ $league->id }}">
                                    {{ $league->name}}
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="mb-2 text-grey-darker">You aren't currently in any leagues.</div>
                    @endif
                </p>
              </div>
            </div>
        </div>

        <div>

        </div>
    @endif

    <div class="flex justify-between" style="padding: 15px;">
        <a href="{{ route('league.index') }}" class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded m-2" style="text-decoration: none;">
            Join League
        </a>
        <a href="{{ route('league.create') }}" class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded m-2" style="text-decoration: none;">
            Create League
        </a>
    </div>
@endsection