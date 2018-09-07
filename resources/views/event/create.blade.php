@extends('master')

@section('body')
    <div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>Create Tasting Event for {{ $group->name }}</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                <i class="fa fa-beer fa-4x"></i>
            </div>

            <div style="padding-top:15px;">
                <form action="{{ route('event.store') }}" method="POST">
                    <div class="mb-4">
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="group" type="text" name="name" placeholder="Beer Genre">
                    </div>
                    <div class="mb-4">
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="group" type="text" name="address" placeholder="Address">
                    </div>
                    <div class="mb-4">
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="group" type="text" name="starts_at" placeholder="Starts At">
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="group_id" value="{{ $group->id }}" />
                        {{ csrf_field() }}
                        <input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Create Event" />
                    </div>
                </form>
            </div>
 
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection