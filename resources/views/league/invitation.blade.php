@extends('master')

@section('body')
    @include('layout.title', ['name' => $league->name])
    
    <div class="flex flex-col">
        <div class="text-center p-4">
            You have been invited to join {{ $league->name }}.  If you don't want to accept you can just ignore this email.
        </div>
        <div class="text-center p-4">
            <a class="bg-white hover:bg-yellow text-yellow-dark font-semibold hover:text-white py-2 px-4 border border-yellow hover:border-transparent rounded cursor-pointer no-underline" href="{{ route('leagueuser.update', ['league' => $league]) }}?email={{ $invitation->email }}&id={{ $invitation->id }}">Accept Invitation</a>
        </div>
    </div>
@endsection