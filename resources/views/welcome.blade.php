<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="be190591e473b069" />

        <title>Homepage | Teach and learn</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ URL::to('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="links">
                    @foreach(__('navbar.header') as $key => $value)
                        <a href="{{$value['url']}}">{{$value['title']}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
