@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="bc">
                            <a href="/">Categories</a>&nbsp;>&nbsp;
                            <div>{{ $category->name }}</div>
                        </div>
                        <div class="entity-add">
                            <a href="{{ route('categories.subcategories.create', $category->id) }}">
                                <button class="btn btn-success">Add Subategory</button>
                            </a>
                        </div>
                    </div>

                    <div class="panel-body" style="padding: 0 15px">
                        @foreach($category->subcategories as $subcategory)
                            <div class="row">
                                <div class="col-md-12 entity">
                                    <div class="entity-name">
                                        {{ $subcategory->name }}
                                    </div>
                                    <div class="entity-btn">
                                        <a href="{{ route('categories.subcategories.show', [$category->id, $subcategory->id]) }}">
                                            <button type="button" class="btn btn-info">View</button>
                                        </a>
                                        @if(Auth::check())
                                            <a href="{{ route('categories.subcategories.edit', [$category->id, $subcategory->id]) }}">
                                                <button type="button" class="btn btn-warning">Edit</button>
                                            </a>
                                            <form action="{{ route('categories.subcategories.destroy', [$category->id, $subcategory->id]) }}" method="post">
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
