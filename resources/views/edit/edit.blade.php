@extends ('layouts.default')
@section ('title', 'Whisper Login')

@section ('header')
@include ('layouts._header')
@stop

@section ('content')
<div id="content">
    <div class="content-menu">
        <ul class="sub-menu">
            <li><a href="#url=edit?table=topics" class="nav-btn">topics</a></li>
            <li><a href="#url=edit?table=feeds" class="nav-btn">feeds</a></li>
            <li><a class="page" href="#aaa" class="nav-btn">aaa</a></li>
        </ul>
    </div>
    <div class="content-main">
        @yield ('content-main')
    </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script> 
@stop

