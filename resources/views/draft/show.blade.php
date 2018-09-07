@extends('master')

@section('body')
    <div class="w-full max-w-xs mx-auto mt-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2>Season Draft</h2>

            <div style="color: #F2D024; width: 100%; text-align: center; padding: 25px;">
                <i class="fa fa-beer fa-4x"></i>
            </div>

            @if(Auth::user()->can('update', $draft->season->league) && !$draft->started_at)
            	<form action="{{ route('draft.update', ['id' => $draft->id]) }}" method="POST">
            		<input type="hidden" name="_method" value="PUT" />
				    <div class="mb-4">
				    	{{ csrf_field() }}
				    	<input type="hidden" name="start" value="true" />
				    	<input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="Start Draft" />
				    </div>
				</form>
            @elseif(Auth::user()->can('update', $draft->season->league))
				<form action="{{ route('draft.update', ['id' => $draft->id]) }}" method="POST">
            		<input type="hidden" name="_method" value="PUT" />
				    <div class="mb-4">
				    	{{ csrf_field() }}
				    	<input type="hidden" name="staendrt" value="true" />
				    	<input class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" type="submit" value="End Draft" />
				    </div>
				</form>
            @endif

            @if(!$draft->started_at)
            	<h4>Draft has not started yet!</h3>
            @endif
    		
            @foreach($draft->draftList() as $group => $members)
    		    <div>
                    <h4>{{ $group }}</h4>
                    <table style="background: white;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                @for($x = 1; $x <= $draft->rounds; $x++)
                                    <th>{{ $x }}</th>
                                @endfor
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                                <tr @if($draft->turn($member)) class="turn" @endif>
                                    <td>{{ $member->name }}</td>
                                    <form action="{{ route('draft.update', ['draft' => $draft]) }}" method="POST">
                                    @for($x = 1; $x <= $draft->rounds; $x++)
                                        <td>
                                        @if(!$draft->started_at || !$draft->turn($member) || $draft->round($group) != $x)
                                            <input type="text" style="border: 1px solid grey" @if($draft->brewery($member->id, $draft->season->id, $x)) value="{{ $draft->brewery($member->id, $draft->season->id, $x)->name }}" @endif disabled />
                                        @else
                                            <input type="text" class="typeahead" style="border: 1px solid grey" />
                                            <input type="hidden" id="brewery" name="brewery" />
                                            <input type="hidden" id="brewery-id" name="brewery-id" />
                                        @endif
                                        </td>
                                    @endfor
                                    <td>
                                        <input type="hidden" name="_method" value="PUT" />
                                        {{ csrf_field() }}
                                        <input type="submit" value="Submit" />
                                    </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
				</div>
            @endforeach
        </div>
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var engine = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('brewery_name'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              remote: {
                url: '/untappd/brewery/%QUERY',
                wildcard: '%QUERY'
              }
            });

            $('.typeahead').typeahead(null, {
              name: 'breweries',
              display: 'brewery_name',
              source: engine
            }).on('typeahead:selected', function(event, selection) {
                // update the input val
                $('#brewery-id').val(selection.brewery_id);
                $('#brewery').val(selection.brewery_name);
            });
        });
    </script>
@endpush