@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Create Post
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.store') }}">
                        @csrf
                        
                        <div class="mb-3 d-flex">
                            <label for="title" class="col-4 p-2 col-form-label text-md-end">Title</label>

                            <div class="col-6">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-3 d-flex">
                            <label for="description" class="col-md-4 p-2 col-form-label text-md-end">Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required>

                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
