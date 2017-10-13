<!DOCTYPE html>
<html>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <head>
    <title>@yield('title', 'Whisper')</title>
    <link rel="stylesheet" href="/css/app.css">
    <script type="text/javascript" src="js/app.js"></script>
  </head>
  <body>
    @yield ('header')

    <div>
      @include ('shared._messages')
      @yield ('content')
    </div>
  </body>
</html>
