@extends('master')

@section('body')
	<div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>Assign Groups</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <p>
                @foreach($season->groups as $group)
                    <div id="group-{{ $group->id }}" style="border: thin solid black; padding: 5px; margin-bottom: 5px;">
                        <h4>{{ $group->name }}</h4>
                        <form action="{{ route('group.update', ['group' => $group->id]) }}" method="POST">
                            @foreach($season->league->members as $member)
                                <div><input type='checkbox' name="members[]" value="{{ $member->id }}" /> <input type="checkbox" name="leaders[]" value="{{ $member->id }}" /> {{ $member->name }}</div>
                            @endforeach
                            <input type="hidden" name="_method" value="PUT" />
                            {{ csrf_field() }}
                            <input type="Submit" value="Save Group" />
                        </form>
                    </div>
                @endforeach
            </p>
            
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection