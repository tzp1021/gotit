@extends ('layouts.default')
@section ('title', 'Whisper Login')

@section ('header')
@include ('layouts._header')
@stop

@section ('content')
<div id="content">
    <div class="content-menu">
        <ul class="sub-menu">
            <li><a href="#url=edit?action=indexTopicList" class="nav-btn">topics</a></li>
            <li><a href="#url=edit?action=indexDataFlow" class="nav-btn">feeds</a></li>
        </ul>
    </div>
    <div class="content-main">
        @yield ('content-main')
    </div>
</div>
@stop

