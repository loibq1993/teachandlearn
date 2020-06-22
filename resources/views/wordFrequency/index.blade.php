@section('title', 'Word frequency')
@extends('layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/wordFrequency.css') }}">
@stop
@section('content')
    <div class="container py-4">
        <h1>{{__('wordFrequency.title')}}</h1>
        <div class="body wordFrequencyCounter">
            <ul class="nav nav-tabs mb-3" id="tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#text" role="tab" aria-controls="tab-text" aria-selected="true">{{__('wordFrequency.tab.nav-text')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="tab-upload" aria-selected="false">{{__('wordFrequency.tab.nav-upload')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="text" role="tabpanel" aria-labelledby="text-tab">
                    <form action="#" method="post">
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="100" valign="top"><b>{{__()}}</b></td>
                                    <td width="80%" valign="top">
                                        <textarea name="text" rows="10" style="width:80%"></textarea><br>
                                        <button id="button" type="button" class="btn btn-primary">Submit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                </div>
                <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                    <form action="{{route('wordFrequency.import')}}" class="dropzone">
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
    </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.js"></script>
    <script src="{{ asset('js/wordFrequency.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
@stop
