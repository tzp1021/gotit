<header class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <a href="/" id="logo">Whisper</a>
      <nav>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a id="logout" href="#">
              <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-block btn-danger" type="submit" name="button">Logout</button>
               </form>
             </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>
