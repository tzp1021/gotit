<div class="tab-container">
    <div class="search-box">
        <input type="text" id="name" placeholder="name">
        <button class="btn btn-info" id="topic-search">search</button>
        <button class="btn btn-primary" id="topic-create" data-toggle="modal" data-target="#myModal">new</button>
    </div>
    <div class="cate-list">
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
            <tbody>
                @foreach ($topics as $topic)
                    <tr>
                        <td class="topic-id">{{ $topic->id }}</td>
                        <td class="topic-name">{{ $topic->name }}</td>
                        <td class="topic-icon"><img style="width:40px; height:40px;" src="{{ $topic->icon_url }}"/></td>
                        <td>{{ $topic->sort }}</td>
                        <td>{{ $topic->insert_time }}</td>
                        <td>
                            <button class="btn btn-primary topic-edit" data-toggle="modal" data-target="#myModal">edit</button>
                            @if ($topic->status == 0)
                                <button class="btn btn-danger topic-line">offline</button>
                            @else
                                <button class="btn btn-success topic-line">online</button>
                            @endif
                        </td>
                        <td class="topic-abstract" style="display:none">{{ $topic->abstract }}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        @include ('pagination.default', ['paginator' => $topics, 'url' => '#url=edit?table=topics&page='])
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
                    <button type="submit" class="btn btn-primary" id="topic-commit">commit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
</div>
