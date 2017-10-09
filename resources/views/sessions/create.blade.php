@extends ('layouts.default-login')
@section ('title', 'Whisper Login')

@section ('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>Login for edit</h5>
    </div>
    <div class="panel-body">
      @include ('shared._errors')

      <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="email">user name：</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="password">password：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <hr>
    </div>
  </div>
</div>
@stop
