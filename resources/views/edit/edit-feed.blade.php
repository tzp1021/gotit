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
                    <th>title</th>
                    <th>cover</th>
                    <th>date</th>
                    <th>topic</th>
                    <th>operate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feeds as $feed)
                    <tr>
                        <td>{{ $feed->id }}</td>
                        <td>{{ $feed->title }}</td>
                        <td>I'm cover</td>
                        <td>{{ $feed->date }}</td>
                        <td>{{ $feed->topic_id }}</td>
                        <td>edit</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        @include ('pagination.default', ['paginator' => $feeds, 'url' => '#url=edit?table=feeds&page='])
    </div>
</div>
