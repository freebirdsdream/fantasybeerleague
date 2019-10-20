@extends('master')

@section('body')
    @include('layout.header', ['name' => $rules->league->name . ' Rules'])

    <div class="w-5/6 m-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6">
        {!! Markdown::convertToHtml($rules->text) !!}
    </div>
@endsection