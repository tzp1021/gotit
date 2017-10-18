$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    initContentMain();

    $(".nav-btn").click(function() {
        console.log('nav-btn click');        
    });
    
});

function initContentMain() {
    console.log("initContentMain");
    var href = location.hash;
    if(href==="") {
        href = $(".nav-btn:first").attr("href");
        location.hash = href;
        return;
    }
    var url = href.substr(href.indexOf('=')+1);
    getDataContentMain(url);
}


$(window).bind("hashchange", function(){
    var href = location.hash;
    console.log(href);
    if(href.indexOf("url=") == -1) {
        console.log('hashchange return')
        return;
    }
    var url = href.substr(href.indexOf('=')+1);
    getDataContentMain(url);
});

function getDataContentMain(url) {
    console.log("getDataContentMain:"+url);
    $.ajax({
        url:url,
        type:"GET",
        success:function(res) {
            $(".content-main").html(res);
        },
    });
}
