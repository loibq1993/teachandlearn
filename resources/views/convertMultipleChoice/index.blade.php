@section('title', __('convertMultipleChoice.title'))
@extends('layouts.master')
@section('css')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/wordFrequency.css') }}">--}}
@stop
@section('content')
    <div class="container py-4">
        <h1>{{__('convertMultipleChoice.title')}}</h1>
        <div class="body" id="convertMultipleChoice">
            <div id="upload">
                <form action="{{route('convertMultipleChoice.import')}}" class="dropzone" method="post">
                    @csrf
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
                <div class="download-link">

                </div>
            </div>
        </div>
    </div>
@endsection
