@extends('layouts.default')

@section('content')

    @include('includes.navbar',['sheets' => $sheets, 'file_id'=>$file_id])



    <div class="row">
        <div class="col-10">
            <canvas id="chart1" ></canvas>
            <script>
                const ctx = document.getElementById('chart1').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach($charts as $c)

                            @endforeach
                        ],
                        datasets: [{
                            label: '{{$charts['table1']['table_name']}}',
                            data: [

                                @foreach(array_slice($charts['table1']['rows'],0) as $row)
                                    @foreach(array_slice($row,1) as $col)
                                        {x: '{{current($row)}}',y:'{{($col)}}'},

                                    @endforeach
                                @endforeach

                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="col-2">
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
        </div>
    </div>

    <div class="row">
        <div class="col-10">
            <canvas id="chart2" ></canvas>
            <script>
                const ctx2 = document.getElementById('chart2').getContext('2d');
                const myChart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach($charts as $c)

                            @endforeach
                        ],
                        datasets: [{
                            label: '{{$charts['table2']['table_name']}}',
                            data: [

                                    @foreach(array_slice($charts['table2']['rows'],0) as $row)
                                    @foreach(array_slice($row,1) as $col)
                                {x: '{{current($row)}}',y:'{{($col)}}'},

                                @endforeach
                                @endforeach

                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="col-2">
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
        </div>
    </div>

    <div class="row">
        <div class="col-10">
            <canvas id="chart3" ></canvas>
            <script>
                const ctx3 = document.getElementById('chart3').getContext('2d');
                const myChart3 = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach($charts as $c)

                            @endforeach
                        ],
                        datasets: [{
                            label: '{{$charts['table3']['table_name']}}',
                            data: [

                                    @foreach(array_slice($charts['table3']['rows'],0) as $row)
                                    @foreach(array_slice($row,1) as $col)
                                {x: '{{current($row)}}',y:'{{($col)}}'},

                                @endforeach
                                @endforeach

                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="col-2">
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
                <table class="tables_1 table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
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
        </div>
    </div>

    <div class="row">
        <div class="col-10">
            <canvas id="chart4" ></canvas>
            <script>
                const ctx4 = document.getElementById('chart4').getContext('2d');
                const myChart4 = new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach($charts as $c)

                            @endforeach
                        ],
                        datasets: [{
                            label: '{{$charts['table4']['table_name']}}',
                            data: [

                                    @foreach(array_slice($charts['table4']['rows'],0) as $row)
                                    @foreach(array_slice($row,1) as $col)
                                {x: '{{current($row)}}',y:'{{($col)}}'},

                                @endforeach
                                @endforeach

                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="col-2">
            <div class="row ">
                <div class="col">
                    <div class="card card-sheet-name">
                        <div class="card-body">
                            {{$tables['table4']['table_name']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-block">
                <table class="tables_1 table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        @foreach($tables['table4']['header_row'] as $cell)
                            <th class="header-cell text-start">
                                {{$cell}}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tables['table4']['rows'] as $i => $row)
                        <tr class="" >
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
        </div>
    </div>

    <div class="row">
        <div class="col-10">
            <canvas id="chart5" ></canvas>
            <script>
                const ctx5 = document.getElementById('chart5').getContext('2d');
                const myChart5 = new Chart(ctx5, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach($charts as $c)

                            @endforeach
                        ],
                        datasets: [{
                            label: '{{$charts['table5']['table_name']}}',
                            data: [
                                    @foreach(array_slice($charts['table5']['rows'],0) as $row)
                                        @foreach(array_slice($row,1) as $col)
                                            {x: '{{current($row)}}-{{$i}}',y:'{{($col)}}'},

                                        @endforeach
                                    @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="col-2">
            <div class="row ">
                <div class="col">
                    <div class="card card-sheet-name">
                        <div class="card-body">
                            {{$tables['table5']['table_name']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-block">
                <table class="tables_1 table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        @foreach($tables['table5']['header_row'] as $cell)
                            <th class="header-cell text-start">
                                {{$cell}}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tables['table5']['rows'] as $i => $row)
                        <tr class="" >
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
        </div>
    </div>


@stop
