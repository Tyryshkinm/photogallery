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

                    <div class="panel-body" style="padding: 0 15px">
                        @foreach($categories as $category)
                            <div class="row">
                                <div class="col-md-12 entity">
                                    <div class="entity-name">
                                        {{ $category->name }}
                                    </div>
                                    <div class="entity-btn">
                                        <a href="{{ route('categories.show', $category->id) }}">
                                            <button type="button" class="btn btn-info">View</button>
                                        </a>
                                        @if(Auth::check())
                                            <a href="{{ route('categories.edit', $category->id) }}">
                                                <button type="button" class="btn btn-warning">Edit</button>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
