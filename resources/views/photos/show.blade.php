@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $photo->description }}</div>

                    <div class="panel-body">
                        <div class="photo">
                            <img src="{{ asset('storage/photos/sources/' . $photo->path) }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
