@section('title', __('flashCard.title'))
@extends('layouts.master')
@section('css')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/wordFrequency.css') }}">--}}
@stop
@section('content')
    <div class="container py-4">
        <h1>{{__('flashCard.title')}}</h1>
        <div class="body" id="flashCard">
            <div class="options mb-2">
                <div class="export-type col-md-6 float-left">
                    <label for="type" class="col-md-4">Export file type</label>
                    <select id="type" class="form-control d-inline-block col-md-3">
                        <option value="word">Word</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="number col-md-6 float-left">
                    <label for="number-card" class="col-md-4">Number card / page</label>
                    <select id="number-card" class="form-control d-inline-block col-md-3">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="upload">
                <form action="{{route('flashCard.import')}}" class="dropzone" method="post">
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
