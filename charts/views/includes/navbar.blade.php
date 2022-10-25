
<div class="col-12">
    <div class="row justify-content-start">
        <div class="col">
            <ul class="nav">
                @foreach($sheets as $sheet)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?file_id={{$file_id}}&sheet={{$sheet['id']}}">{{$sheet['sheet_name']}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
