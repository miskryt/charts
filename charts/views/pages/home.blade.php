@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col">

            <div class="border border-light p-3 mb-4">

                <div class="d-flex align-items-center justify-content-center" style="height: 350px">
                    <div class="list-group d-flex justify-content-center">
                        @foreach ($files as $file)
                            <a href="?file_id={{$file['id']}}" class="list-group-item list-group-item-action px-3 border-0">{{$file['filename']}}</a>
                        @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>

@stop
