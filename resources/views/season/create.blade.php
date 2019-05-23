@extends('master')

@section('body')
    <img class="w-full rounded-t" src="https://craftbeerclub.com/media/gm/user/gmwc/img_cbc/craft-beer-club-beer-flight.jpg" alt="Sunset in the mountains">
    @include('layout.title', ['name' => $league->name . ' - Create Season'])

    <div id="date" class="hidden" year="{{ date('Y') }}" month="{{ date('m') }}" day="{{ date('d') }}"></div>
    <div id="season" class="px-8 pb-4">
        <div class="mt-8 mb-8 w-full lg:flex">
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://www.recorder.com/getattachment/4706aa44-1488-4721-8219-2f5eb7b58645/AC-calendar-122018-ph01')" title="Woman holding a mug">
            </div>
            <div class="w-full border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <form action="{{ route('season.store') }}" method="POST">
                        <h4>Beers Allowed</h4>
                        <div class="flex flex-wrap mb-4">
                            <div id="styles" class="flex flex-wrap">
                                @foreach($styles as $style)
                                    <div class="m-1 p-4 border border-yellow-light rounded-lg bg-yellow-lighter hover:bg-yellow cursor-pointer" title="{{ $style->brewers_association->implode(', ') }}" @click="toggleStyle($event)">
                                        {{ $style->style }}
                                        <input type='checkbox' class="hidden" name="styles[]" value="{{ $style->id }}" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex">
                                <input type="text" id="customStyle" class="p-4 rounded-lg border border-grey" placeholder="Custom Style">
                                <div id="addStyle" class="border border-yellow-light bg-yellow text-white rounded-lg p-4 hover:bg-yellow-dark cursor-pointer" @click="addCustomStyle">Add</div>
                            </div>
                        </div>
                        
                        <h4>Start/End Dates (tentative)</h4>
                        <div class="flex mb-4 justify-between items-center">
                            <datepicker class="border border-yellow-lighter rounded-lg p-2 w-2/5" :value="date" name="uniquename"></datepicker>
                            To
                            <datepicker class="border border-yellow-lighter rounded-lg p-2 w-2/5" :value="date" name="uniquename"></datepicker>
                        </div>
                        
                        <h4>Meeting Days</h4>
                        <div class="flex flex-wrap mb-4">
                            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                <div class="m-1 p-4 border border-yellow-light rounded-lg bg-yellow-lighter hover:bg-yellow cursor-pointer" title="{{ $day }}" @click="toggleStyle($event)">
                                    {{ $day }}
                                    <input type='checkbox' class="hidden" name="days[]" value="{{ strtolower($day) }}" />
                                </div>
                            @endforeach
                        </div>

                        <h4>Meeting Time</h4>
                        <div class="flex flex-wrap mb-4">
                            @foreach(['Morning', 'Afternoon', 'Evening'] as $time)
                                <div class="m-1 p-4 border border-yellow-light rounded-lg bg-yellow-lighter hover:bg-yellow cursor-pointer" title="{{ $time }}" @click="toggleStyle($event)">
                                    {{ $time }}
                                    <input type='checkbox' class="hidden" name="times[]" value="{{ strtolower($time) }}" />
                                </div>
                            @endforeach
                        </div>

                        {{ csrf_field() }}
                        <input type="hidden" name="league_id" value="{{ $league->id }}" />

                        <input type="submit" class="m-1 p-4 border border-yellow-light rounded-lg bg-yellow hover:bg-yellow cursor-pointer" value="Save Season and Send Surveys" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush