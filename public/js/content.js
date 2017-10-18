var curTr;
var curBtn;

$(".topic-edit").on('click', function(){
    console.log("topic-edit");
    $("#add-cate-frm")[0].reset();
    curTr = $(this).parents("tr");
    console.log(curTr.children("td.topic-id:first").text());
    $("#add-cate-frm input[name='id']").val(curTr.children("td.topic-id:first").text());
    $("#add-cate-frm textarea[name='name']").val(curTr.children("td.topic-name:first").text());
    $("#add-cate-frm textarea[name='abstract']").val(curTr.children("td.topic-abstract:first").text());
    $("#add-cate-frm input[name='icon_url']").val(curTr.children("td.topic-icon:first").children("img").attr("src"));
});

$("#topic-create").click(function(){
    console.log("create click");
    $("#add-cate-frm")[0].reset();
});

$("#topic-commit").click(function(){
    var formData = new FormData($( "#add-cate-frm" )[0]);
    $.ajax({
        url:"/edit?action=updateTopic",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(res) {
            console.log(res);
            var result = JSON.parse(res);
            if(result.errCode == 0) {
                curTr.children("td.topic-name:first").text(result.data.topic.name);
                curTr.children("td.topic-abstract:first").text(result.data.topic.abstract);
                curTr.children("td.topic-icon:first").children("img").attr("src", result.data.topic.icon_url);
            }
            $("#myModal").modal('hide');
            alert("edit succeed");
        },
        error:function(res) {
            console.log(res);
            $("#myModal").modal('hide');
            alert("edit failed");
        }
    });
});

$(".topic-line").click(function() {
    curTr = $(this).parents("tr");
    curBtn = $(this);
    var id = curTr.children("td.topic-id:first").text();
    console.log(id);
    $.ajax({
        url:"/edit?action=updateTopicStatus",
        type:"POST",
        dataType:'json',
        data:{'id':id},
        success:function(result) {
            console.log(result);
            if(result.errCode == 0) {
                var curBtnClz = curBtn.attr('class');
                console.log(curBtnClz);
                if(result.data.status == 0) {
                    curBtn.text('offline');
                    curBtnClz = curBtnClz.replace('btn-success', 'btn-danger');
                } else {
                    curBtn.text('online');
                    curBtnClz = curBtnClz.replace('btn-danger', 'btn-success');
                }
                console.log(curBtnClz);
                curBtn.attr('class', curBtnClz);
            }
        }
    });
});
