@extends('master')

@section('body')
	<div class="w-full mx-auto mt-6">
        <div class="px-8 pt-6 pb-8 mb-4">
            <div class="font-semibold text-2xl text-center">Assign Groups</div>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <p>
                @foreach($season->groups as $group)
                    <div id="group-{{ $group->id }}" class="p-2 mb-4 w-full @if(!$loop->first) border-t border-grey-light @endif">
                        <div class="font-semibold text-lg mb-2 text-yellow-dark">{{ $group->name }}</div>
                        <form action="{{ route('group.update', ['group' => $group->id]) }}" method="POST">
                            <table class="w-4/5">
                                <thead>
                                    <tr class="border-b border-yellow-light text-yellow-dark">
                                        <th class="text-left pb-2">Leader</th>
                                        <th class="text-left pb-2">Member</th>
                                        <th class="text-left pb-2">Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($season->league->members as $member)
                                        <tr>
                                            <td class="@if($loop->first) pt-2 @endif">
                                                <input type="checkbox" name="leaders[]" value="{{ $member->id }}" />
                                            </td>
                                            <td class="@if($loop->first) pt-2 @endif">
                                                <input type='checkbox' name="members[]" value="{{ $member->id }}" />
                                            </td>
                                            <td class="@if($loop->first) pt-2 @endif">
                                                {{ $member->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="_method" value="PUT" />
                            {{ csrf_field() }}
                            <div class="w-full flex justify-end">
                                <input type="Submit" class="p-2 border border-yellow-light rounded bg-yellow cursor-pointer hover:bg-yellow-dark" value="Save Group" />
                            </div>
                        </form>
                    </div>
                @endforeach
            </p>
            
        </div>
    </div>
@endsection