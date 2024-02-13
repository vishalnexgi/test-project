@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Posts
                    <a style="float: right" role="button" href="{{ route('post.create') }}">Add Post</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="col-12" style="text-align: center;">
                        <tr>
                            <td style="width: 10%;">Sl. No</td>
                            <td style="width: 30%;">Title</td>
                            <td style="width: 40%;">Description</td>
                            <td style="width: 10%;">Status</td>
                            <td style="width: 10%;">Action</td>
                        </tr>
                        @foreach($posts as $index => $post)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $post->post_title }}</td>
                            <td>{{ $post->post_content }}</td>
                            <td>{{ $post->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('post.status',$post->id) }}">Status Change</a>
                                <br>
                                <a href="{{ route('post.edit',$post->id) }}">Edit</a>
                                <br>
                                <a href="{{ route('post.delete',$post->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
