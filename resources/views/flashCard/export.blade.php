<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ URL::to('css/flashCard.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .content {
            width: 794px;
            height: 1122px;
            margin: auto;
        }
        .flash-card {
            border: 2px solid #000000;
            text-align: center;
            padding: 30px 0;
        }
        .flash-card > div:not(:first-child) {
            padding-top: 16px;
        }
        .main-word {
            color: #203864;
            font-size: 35px;
            font-weight: bold;
        }
        .word-type {
            font-size: 25px;
        }
        .pronunciation {
            font-size: 20px;
        }
        .example-sentence {
            font-size: 20px;
            color: red;
            font-style: italic;
            margin-top: 25px;
        }
        .vietnamese {
            font-size: 25px;
            font-weight: bold;
            margin-top: 25px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="flash-card">
            ABC
            <div class="main-word">Environment</div>
            <div class="word-type">(N)</div>
            <div class="pronunciation">/en’vairӘnmӘnt/</div>
            <div class="example-sentence">The factors, objects and conditions that surround something</div>
            <div class="vietnamese">Môi trường</div>
        </div>
    </div>
</div>
</body>
</html>
