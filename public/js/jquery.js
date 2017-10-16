$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    initContentMain();

    $("#search").click(function() {
        console.log('search click');
        window.open("http://www.baidu.com","","top=100,left=100,width=300,height=200");
    });
});

function initContentMain() {
    var href = location.hash;
    if(href==="") {
        href = $(".nav-btn:first").attr("href");
    }
    var url = href.substr(href.indexOf('=')+1);
    getDataContentMain(url);
}

$(window).bind("hashchange", function(){
    var href = location.hash;
    if(href.indexOf("url=") == -1) {
        return;
    }
    var url = href.substr(href.indexOf('=')+1);
    getDataContentMain(url);
});

function getDataContentMain(url) {
    $.get(url, function(data, status){
        $(".content-main").html(data);
    });
}
