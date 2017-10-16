$(".topic-edit").click(function(){
    $("#add-cate-frm")[0].reset();
    var tr = $(this).parents("tr");
    console.log(tr.children("td.topic-id:first").text());
    $("#add-cate-frm input[name='id']").val(tr.children("td.topic-id:first").text());
    $("#add-cate-frm textarea[name='name']").val(tr.children("td.topic-name:first").text());
    $("#add-cate-frm textarea[name='abstract']").val(tr.children("td.topic-abstract:first").text());
    $("#add-cate-frm input[name='icon_url']").val(tr.children("td.topic-icon:first").children("img").attr("src"));
});

$("#topic-create").click(function(){
    console.log("create click");
    $("#add-cate-frm")[0].reset();
});

$("#topic-commit").click(function(){
    var formData = new FormData($( "#add-cate-frm" )[0]);
    $.ajax({
        url:"/edit",
        type:"POST",
        async:false,
        cache:false,
        data:formData,
        contentType:false,
        processData:false,
        success:function(res) {
            $("#myModal").modal('hide');
            alert("edit succeed");
        },
        error:function(res) {
            $("#myModal").modal('hide');
            alert("edit failed");
        }
    });
});
