$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){

    $(".nav-btn").click(function() { 
        var href = $(this).attr("href");
        var url = href.substr(href.indexOf('=')+1);
        $.get(url, function(data, status){
            $(".content-main").html(data);
        });
    });

    var hash = location.hash;
    if(hash==="") {
        var href = $(".nav-btn:first").attr("href");
        console.log(href);
        var url = href.substr(href.indexOf('=')+1);
        $.get(url, function(data, status){
            $(".content-main").html(data);
        });
    } else {
        var href = location.hash;
        var url = href.substr(href.indexOf('=')+1);
        $.get(url, function(data, status){
            $(".content-main").html(data);
        });
    }
});

$(window).bind("hashchange", function(){
    console.log("hashchange");
    console.log(location.hash);
    var href = location.hash;
    if(href.indexOf("url=") == -1) {
        return;
    }
    var url = href.substr(href.indexOf('=')+1);
    $.get(url, function(data, status){
        $(".content-main").html(data);
    });
});
