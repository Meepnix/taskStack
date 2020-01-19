<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tasks</title>

  <!-- Fonts -->
  <link rel="stylesheet" 
  href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" 
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" 
  crossorigin="anonymous">



  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <style>
    html, body {
      margin: 0;
      padding: 0;,
      height: 100%;
      width: 100%;
      
    }
  </style>

  
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('task.show')}}"> {{ Auth::user()->name }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Morning</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Early Afternoon</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Late Afternoon</a>
      </li>
    </ul>
  </div>
</nav>

<div id="app"></div>

<script>
    //Pass site route
    var SiteRoute = "{{asset('')}}";
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>

<script src="{{ mix('js/app.js') }}"></script>


<script>

  


</script>
</body>
</html>