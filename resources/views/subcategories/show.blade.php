@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div>Subcategory > {{ $subcategory->name }}</div>
                        <div class="entity-add">
                            <a href="{{ route('categories.subcategories.photos.create', [$subcategory->category_id, $subcategory->id]) }}">
                                <button class="btn btn-success">Add Photo</button>
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @foreach($subcategory->photos as $photo)
                            <div class="row photo">
                                <div class="col-md-9">
                                    <img src="{{ asset('storage/photos/thumbnails/' . $photo->path) }}">
                                    <div>Description: {{ $photo->description }}</div>
                                    <div>Created at: {{ $photo->created_at->format('d M Y - H:i:s') }}</div>
                                    <div>Updated at: {{ $photo->updated_at->format('d M Y - H:i:s') }}</div>
                                </div>

                                <div class="col-md-3 control-buttons">

                                    <a href="{{ route('categories.subcategories.photos.show',
                                    [$subcategory->category_id, $subcategory->id, $photo->id])  }}">
                                        <button type="button" class="btn btn-info">View Source Photo</button>
                                    </a>

                                    <a href="{{ route('categories.subcategories.photos.edit',
                                    [$subcategory->category_id, $subcategory->id, $photo->id]) }}">
                                        <button type="button" class="btn btn-warning">Edit Photo</button>
                                    </a>

                                    <form action="{{ route('categories.subcategories.photos.destroy',
                                    [$subcategory->category_id, $subcategory->id, $photo->id]) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">Delete Photo</button>
                                    </form>

                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
