<div class="tab-container">
    <div class="search-box">
        <input type="text" id="name" placeholder="name">
        <button class="btn btn-info" id="topic-search">search</button>
        <button class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="createClick(this)">new</button>   
    </div>
    <div class="cate-list" style="width:100%">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>LOGO</th>
                    <th>sort</th>                    
                    <th>create time</th>
                    <th>operate</th>                
                </tr>
            </thead>            
            <tbody id="dataTable">
            </tbody>
        </table>
        <ul class="pagination" id="page">
        </ul>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        edit/new
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <form class="form-horizontal" action="{{ route('edit') }}"  method="POST" id="add-cate-frm" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group"  style="display: none">
                                <label class="col-sm-4 control-label">ID</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="id"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">name</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="name" style="width: 300px; height: 100px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">abstract</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="abstract" style="width: 300px; height: 100px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">icon</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="icon_url" style="width: 300px; margin-bottom: 3px"/>
                                    <input type="file" class="form-control upfile" name="picture"  accept="image/png,image/jpg,image/jpeg"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitClick()">submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
	</div><!-- modal fade -->
</div>
<script>
    var pageUrl = '/edit?action=queryTopicList&page=';
    $(function(){
        $.ajax({
            url:pageUrl + '1',
            type:"GET",
            success:function(res) {
                console.log(res);
                fillTable(res.data);
                fillPage(res);
            },
        });
    });

    function fillPage(paginator) {
        console.log('fillPage');
        console.log(paginator);
        console.log(location.hash);
        var pageStr = "";
        var isAble = (paginator.current_page == 1) ? 'disabled' : '';
        var num = (paginator.current_page == 1) ? 1 : paginator.current_page - 1;
        pageStr += '<li class="' + isAble + '">' + '<a class="page" onclick="pageClick(this)"  href="#' + pageUrl + num + '">Prev</a></li>';
        for(var i = 1; i <= paginator.last_page; i++) {
            var isActive = (paginator.current_page == i) ? 'active' : '';
            pageStr += '<li class="' + isActive + '">' + '<a class="page" onclick="pageClick(this)" href="#' + pageUrl + i + '">' + i + '</a></li>';
        }
        isAble = (paginator.current_page == paginator.last_page) ? 'disabled' : '';
        num = (paginator.current_page == paginator.last_page) ? paginator.last_page : paginator.current_page + 1;
        pageStr += '<li class="' + isAble + '">' + '<a class="page" onclick="pageClick(this)" href="#' + pageUrl + num + '">Next</a></li>';
        $('#page').html(pageStr);
    }

    function pageClick(that) {
        console.log('page click');
        console.log(location.hash);
        var url = $(that).attr('href').substr(1);
        console.log(url);
        $(that).attr('href', location.hash);
        $.ajax({
            url:url,
            type:'GET',
            success:function(res) {
                console.log(res);
                fillTable(res.data);
                fillPage(res);
            }
        });
    }

    function fillTable(data) {
        console.log("fillTable");
        console.log(data);
        var tableStr = "";
        var len = data.length;
        for(var i = 0; i < len; i++){
            tableStr += "<tr><td>" + data[i].id + "</td>"
                    + "<td>" + data[i].name + "</td>"
                    + "<td><img style='width:40px;height:40px' src='" + data[i].icon_url + "'/></td>"
                    + "<td>" + data[i].sort + "</td>"
                    + "<td>" + data[i].insert_time + "</td>"
                    + "<td><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='editClick(this)'>edit</button>";
            if(data[i].status == 0) {
                tableStr += '<button class="btn btn-danger" onclick="offlineTopic(this)">offline</button>';
            } else {
                tableStr += '<button class="btn btn-success" onclick="onlineTopic(this)">online</button>';
            }
            tableStr += '</td><td class="topic-abstract" style="display:none">' + data[i].abstract + '</td></tr>';
        }
        $('#dataTable').html(tableStr);
    }

    function offlineTopic(that) {
//        if(confirm('sure offline?')) {
            updateTopicStatus(that, 1);
//        }
    }

    function onlineTopic(that) {
//        if(confirm('sure online?')) {
            updateTopicStatus(that, 0);
//        }
    }

    function updateTopicStatus(that, status) {
        console.log('updateTopicStatus');
        console.log(status);
        var tr = $(that).parents("tr");
        var id = tr.children("td:eq(0)").text();
        var curBtn = $(that);
        console.log(id);
		$.ajax({
        url:"/edit?action=updateTopicStatus",
            type:"POST",
            dataType:'json',
            data:{'id':id, 'status':status},
            success:function(result) {
                console.log(result);
                if(result.errCode == 0) {
                    var curBtnClz = curBtn.attr('class');
                    if(result.data.status == 0) {
                        curBtn.replaceWith('<button class="btn btn-danger" onclick="offlineTopic(this)">offline</button>');
                    } else {
                        curBtn.replaceWith('<button class="btn btn-success" onclick="onlineTopic(this)">online</button>');
                    }
                }
            }
        });
    }

    var curTr;
    function editClick(that){
		console.log("topic-edit");
		$("#add-cate-frm")[0].reset();
		curTr = $(that).parents("tr");
        console.log(curTr);
		console.log(curTr.children("td:eq(0)").text());
		$("#add-cate-frm input[name='id']").val(curTr.children("td:eq(0)").text());
		$("#add-cate-frm textarea[name='name']").val(curTr.children("td:eq(1)").text());
		$("#add-cate-frm textarea[name='abstract']").val(curTr.children("td:eq(6)").text());    
		$("#add-cate-frm input[name='icon_url']").val(curTr.children("td:eq(2)").children("img").attr("src"));
	}

    function createClick(that) {
        console.log("create click");
        $("#add-cate-frm")[0].reset();
    }

    function submitClick(){
        console.log("submit click");
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
					curTr.children("td:eq(1)").text(result.data.topic.name);
					curTr.children("td:eq(6)").text(result.data.topic.abstract);
					curTr.children("td:eq(2)").children("img").attr("src", result.data.topic.icon_url);
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
	};
</script>
