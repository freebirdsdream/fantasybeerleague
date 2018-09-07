@extends('master')

@section('body')
    <div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>Welcome {{ Auth::user()->name }},</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            @if(!$leagues)
                You aren't a part of any leagues right now.
            @else
                <ul>
                @foreach($leagues as $league)
                    <li><a href="/league/{{ $league->id }}">{{ $league->name}}</a></li>
                @endforeach
                </ul>
            @endif

            <div style="text-align: center; padding: 15px;">
                <a href="{{ route('league.create') }}" class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" style="text-decoration: none;">
                    Create New League
                </a>
            </div>

            <div style="text-align: center; padding: 15px;">
                <a href="{{ route('league.index') }}" class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" style="text-decoration: none;">
                    Join League
                </a>
            </div>
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection