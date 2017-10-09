<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Whisper')</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @yield('header')

    <div>
      <div >
        @include('shared._messages')
        @yield('content')
      </div>
    </div>
  </body>
</html>
