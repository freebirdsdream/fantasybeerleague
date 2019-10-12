@extends('master')

@section('body')
    <div class="h-64 overflow-hidden">
        <img class="w-full rounded-t" src="https://craftbeerclub.com/media/gm/user/gmwc/img_cbc/craft-beer-club-beer-flight.jpg" alt="Sunset in the mountains">
    </div>
    @include('layout.title', ['name' => Auth::user()->name . '\'s Beer League Home'])
    <div class="w-5/6 flex flex-wrap justify-around m-auto">

        <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
            <img class="w-full" src="https://blog.edx.org/wp-content/uploads/2018/04/blog-hero.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6">Lifetime Stats</div>
                <p class="text-grey-darker">

                </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
            <img class="w-full" src="https://blog.edx.org/wp-content/uploads/2018/04/blog-hero.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6">Current Stats</div>
                <p class="text-grey-darker">

                </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
            <img class="w-full" src="https://blog.edx.org/wp-content/uploads/2018/04/blog-hero.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6">Leagues</div>
                <p class="text-grey-darker">
                    @foreach($leagues as $league)
                        <a class="no-underline text-grey-darkest group-hover:text-yellow-darker" href="/league/{{ $league->id }}">
                            {{ $league->name}}
                        </a>
                    @endforeach
                </p>
                <div class="flex justify-end w-full">
                    <a href="{{ route('league.index') }}" class="bg-white hover:bg-yellow text-yellow-dark font-semibold hover:text-white py-2 px-4 border border-yellow-dark hover:border-white rounded" style="text-decoration: none;">
                        Join League
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
            <img class="w-full" src="https://blog.edx.org/wp-content/uploads/2018/04/blog-hero.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6">League Admin</div>
                <p class="text-grey-darker w-full">
                    @foreach($leagues as $league)
                        @if(Auth::user()->can('update', $league))
                            <a class="no-underline text-grey-darkest group-hover:text-yellow-darker" href="/league/{{ $league->id }}">
                                {{ $league->name }}
                            </a>
                        @endif
                    @endforeach
                </p>
                <div class="flex justify-end w-full">
                    <a href="{{ route('league.create') }}" class="bg-white hover:bg-yellow text-yellow-dark font-semibold hover:text-white py-2 px-4 border border-yellow-dark hover:border-white rounded" style="text-decoration: none;">
                        Create League
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection