@extends('layouts.default')

@section('content')

    @include('includes.navbar',['sheets' => $sheets, 'file_id'=>$file_id])

    <div class="row ">
        <div class="col">
            <div class="card card-sheet-name">
                <div class="card-body">
                    {{$tables['table1']['table_name']}}
                </div>
            </div>
        </div>
    </div>
    <div class="table-block">
        <table class="tables_1 table table-hover table-border" style="border-style: solid">
            <thead>
                <tr>
                    <th>id</th>
                    @foreach($tables['table1']['header_row'] as $cell)
                        <th class="header-cell text-start">
                            {{$cell}}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
			    @foreach ($tables['table1']['rows'] as $i => $row)
                <tr class="" >
                    <td>{{$i}}</td>
					<?php $j=0;?>
                    @foreach ($row as $colValue)
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            {{$colValue}}
                        </td>
					<?php $j++;?>
                    @endforeach
                </tr>
			    @endforeach
            </tbody>
        </table>
    </div>

    <div class="row ">
        <div class="col">
            <div class="card card-sheet-name">
                <div class="card-body">
                    {{$tables['table2']['table_name']}}
                </div>
            </div>
        </div>
    </div>
    <div class="table-block">
        <table class="tables_1 table table-hover table-border" style="border-style: solid">
            <thead>
            <tr>
                <th>id</th>
                @foreach($tables['table2']['header_row'] as $cell)
                    <th class="header-cell text-start">
                        {{$cell}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($tables['table2']['rows'] as $i => $row)
                <tr class="" >
                    <td>{{$i}}</td>
					<?php $j=0;?>
					<?php foreach ($row as $colValue):?>
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            {{$colValue}}
                        </td>
					<?php $j++;?>
                    @endforeach
                </tr>
				<?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="row ">
        <div class="col">
            <div class="card card-sheet-name">
                <div class="card-body">
                    {{$tables['table3']['table_name']}}
                </div>
            </div>
        </div>
    </div>
    <div class="table-block">
        <table class=" tables_1 table table-hover table-border" style="border-style: solid">
            <thead>
            <tr>
                <th>id</th>
                @foreach($tables['table3']['header_row'] as $cell)
                    <th class="header-cell text-start">
                        {{$cell}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($tables['table3']['rows'] as $i => $row)
                <tr class="" >
                    <td>{{$i}}</td>
					<?php $j=0;?>
					@foreach ($row as $colValue)
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            {{$colValue}}
                        </td>
						<?php $j++;?>
                    @endforeach
                </tr>
				<?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="image-block">
        <div class="row justify-content-start">
            <div class="col">
                <div class="card card-sheet-name">
                    <div class="card-body">
                        {{$tables['table4']['table_name']}}
                    </div>
                </div>
            </div>
        </div>
        <div class="image-div">
            <img class="image" src="data:image/jpeg;base64, {{base64_encode($tables['table4']['images'][0]['image'])}}"/>
        </div>
    </div>

    <div class="image-block">
        <div class="row justify-content-start">
            <div class="col">
                <div class="card card-sheet-name">
                    <div class="card-body">
                        {{$tables['table5']['table_name']}}
                    </div>
                </div>
            </div>
        </div>
        <div class="image-div">
            <img class="image" src="data:image/jpeg;base64, {{base64_encode($tables['table5']['images'][0]['image'])}}"/>
        </div>
    </div>

    <div class="row ">
        <div class="col">
            <div class="card card-sheet-name">
                <div class="card-body">
                    {{$tables['table6']['table_name']}}
                </div>
            </div>
        </div>
    </div>
    <div class="table-block">
        <table class="tables_1 table table-hover table-border" style="border-style: solid">
            <thead>
            <tr>
                <th>id</th>
                @foreach($tables['table6']['header_row'] as $cell)
                    <th class="header-cell text-start">
                        {{$cell}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($tables['table6']['rows'] as $i => $row)
                <tr class="" >
                    <td>{{$i}}</td>
					<?php $j=0;?>
					@foreach ($row as $colValue)
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            {{$colValue}}
                        </td>
                        <?php $j++;?>
                    @endforeach
                </tr>
				<?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="table-block">
        <table class="tables_1 table table-hover table-border" style="border-style: solid">
            <thead>
            <tr>
                <th>id</th>
                @foreach($tables['table7']['header_row'] as $cell)
                    <th class="header-cell text-start">
                        {{$cell}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($tables['table7']['rows'] as $i => $row)
                <tr class="" >
                    <td>{{$i}}</td>
					<?php $j=0;?>
					@foreach ($row as $colValue)
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            {{$colValue}}
                        </td>
						<?php $j++;?>
                    @endforeach
                </tr>
				<?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="table-block">
        <table class="tables_1 table table-hover table-border" style="border-style: solid">
            <thead>
            <tr>
                <th>id</th>
                @foreach($tables['table8']['header_row'] as $cell)
                    <th class="header-cell text-start">
                        {{$cell}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($tables['table8']['rows'] as $i => $row)
                <tr class="" >
                    <td>{{$i}}</td>
					<?php $j=0;?>
					@foreach ($row as $colValue)
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            {{$colValue}}
                        </td>
                        <?php $j++;?>
                    @endforeach
                </tr>
				<?php endforeach;?>
            </tbody>
        </table>
    </div>
@stop
