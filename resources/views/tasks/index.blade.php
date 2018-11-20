<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tasks</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <style>
    html, body {
      margin: 0;
      padding: 0;,
      height: 100%;
      width: 100%;
      background-color: #d1d1d1
    }
  </style>
</head>
<body>

<div id="app"></div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>