    $(".page").click(function(){
        var u = location;
        var cls = $(this).parent().attr("class");
        if(cls.indexOf("disabled") != -1 || cls.indexOf("active") != -1) {
            return;
        }
        var href = $(this).attr("href");
        var url = href.substr(href.indexOf("=")+1);
        $.get(url, function(data, status){
            $(".content-main").html(data);
        });

    });

