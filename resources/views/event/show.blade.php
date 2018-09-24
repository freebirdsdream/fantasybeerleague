@extends('master')

@section('body')
    <div class="container mx-auto pt-8 pb-8">
        <div class="header">
            <h2>{{ $event->name }} Week</h2>
        </div>

        @if($attendanceCheck)
            <div>
                Will you be attending this event?
                <a href="/user/attendance/{{ $event->id }}?attending=1">Yes</a> <a href="">No</a>
            </div>
        @elseif($beerCheck)
            What beer are you bringing? <input type="text" id="beerSearch" class="typeahead" placeholder="Beer" />
        @else
            <div class="scores container">
                @foreach($tastingGroups as $tastingGroup)
                    @include('event.scorecard', ['scores' => $tastingGroup->scores, 'tastingGroup' => $tastingGroup])
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var engine = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('beer_name'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              remote: {
                url: '/untappd/beer/%QUERY',
                wildcard: '%QUERY'
              }
            });

            $('#beerSearch').typeahead(null, {
              name: 'beer',
              display: 'beer_name',
              source: engine
            }).on('typeahead:selected', function(event, selection) {
                // save beer and reload
                console.log(selection);
            });
        });
    </script>
@endpush