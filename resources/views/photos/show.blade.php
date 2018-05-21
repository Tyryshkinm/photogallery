@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="bc">
                            <a href="/">Categories</a>&nbsp;>&nbsp;
                            <a href="/categories/{{ $photo->subcategory->category->id }}">
                                {{ $photo->subcategory->category->name }}
                            </a>&nbsp;>&nbsp;
                            <a href="/categories/{{ $photo->subcategory->category->id }}/subcategories/{{ $photo->subcategory->id }}">
                                {{ $photo->subcategory->name }}
                            </a>&nbsp;>&nbsp;
                        </div>
                        {{ $photo->description }}
                    </div>

                    <div class="panel-body" style="margin-bottom: -16px">
                        <div class="photo">
                            <img src="{{ asset('storage/photos/sources/' . $photo->path) }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
