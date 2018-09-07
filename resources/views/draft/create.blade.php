@extends('master')

@section('body')
	<div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>Create Season {{ $season->number }} Draft</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                    <i class="fa fa-beer fa-4x"></i>
            </div>

            <p>
            	<form action="{{ route('draft.store') }}" method="POST">
				    <div class="mb-4">
				      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="scheduled_start" placeholder="Start Date Time">
				    </div>
                    <div class="mb-4">
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="scheduled_end" placeholder="End Date Time">
                    </div>
                    <div class="mb-4">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="rounds" placeholder="Number of Rounds">
                    <div class="mb-4">
                        <h2>Draft Order </h2>
                        @foreach($season->groups as $group)
                            <div>
                                <h4>{{ $group->name }}</h4>
                                <div id="group1">
                                    @foreach($group->members as $index => $user)
                                        <div>
                                            {{ $user->name }}
                                            <input type="hidden" name="users-{{ $group->id }}[]" value="{{ $user->id }}-{{ $index }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
				    <div class="mb-4">
				    	<input type="hidden" name="season_id" value="{{ $season->id }}" />
				    	{{ csrf_field() }}
				    	<input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Create" />
				    </div>
				</form>
            </p>
            
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection

@push('scripts')
    <script type='text/javascript'>
        $(document).ready(function() {
            dragula([document.getElementById('group1')]).on('drop', function(e, to, from) {
                $(to).children().each(function(index, child) {
                        var value = $(child).children('input').val().split('-');
                        $(child).children('input').val(value[0] + '-' + index);
                    });
            });
        });
    </script>
@endpush