@extends('layouts.default')

@section('content')

    @include('includes.navbar',['sheets' => $sheets, 'file_id'=>$file_id])

    <div class="row">
        <div class="col">
            <h4>
                {{$filename}}
            </h4>
        </div>
    </div>
    <div class="table-block">
        <table class="table table-striped table-hover table-border" id="table_0">

            <thead class="">
                <tr class="header-row">
                    <th>id</th>
                    @foreach ($sheet['header_row'] as $cell)
                    <th class="header-cell align-top">
                        {{$cell}}
                    </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>

            @foreach ($sheet['rows'] as $i => $row)
                <tr id="{{$i}}">
                    <td>{{$i}}</td>
                    @foreach($row as $c => $cell)
                        <td class="cell <?=$c === 0 ? 'header-cell' : ''?>">
                            {{$cell}}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@stop
