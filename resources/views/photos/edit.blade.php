@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Photo</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('categories.subcategories.photos.update', [$categoryId, $photo->subcategory_id, $photo->id]) }}" enctype="multipart/form-data">
                            {{ method_field('put') }}
                            {{ csrf_field() }}

                            <div class="row photo">
                                <div class="col-md-12">
                                    <img src="{{ asset('storage/photos/thumbnails/' . $photo->path) }}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                <label for="photo" class="col-md-4 control-label">New photo</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file" class="form-control" name="photo" required>

                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ $photo->description }}" required>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
