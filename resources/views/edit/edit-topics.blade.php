<div class="tab-container">
    <div class="search-box">
        <input type="text" id="name" placeholder="name">
        <button class="btn btn-info" type="button" id="search">search</button>
        <button class="btn btn-sucess" type="button" id="create">create</button>
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
                        <td>{{ $topic->id }}</td>
                        <td>{{ $topic->name }}</td>
                        <td><img style="width:40px; height:40px;" src="{{ $topic->icon_url }}"/></td>
                        <td>{{ $topic->sort }}</td>
                        <td>{{ $topic->insert_time }}</td>
                        <td>edit</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        @include ('pagination.default', ['paginator' => $topics, 'url' => '#url=edit?table=topics&page='])
    </div>
</div>
