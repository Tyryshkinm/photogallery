@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div>Categories</div>
                        <div class="entity-add">
                            <a href="{{ route('categories.create') }}">
                                <button class="btn btn-success">Add Category</button>
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @foreach($categories as $category)
                            <div class="row category">
                                <div class="col-md-6 category-name">
                                    {{ $category->name }}
                                </div>
                                <div class="col-md-2 category-btn">
                                    <a href="{{ route('categories.show', $category->id) }}">
                                        <button type="button" class="btn btn-info">View</button>
                                    </a>
                                </div>
                                <div class="col-md-2 category-btn">
                                    <a href="{{ route('categories.edit', $category->id) }}">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                </div>
                                <div class="col-md-2 category-btn">
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
