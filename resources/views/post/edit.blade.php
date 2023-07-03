@extends('layouts.app')

@section('extra-css')
    <style>
        .form-control {
            border: 1px solid black;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" method="POST" action="{{ route('post.update') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="hidden" name="id" id="id" value="{{ $post->id }}">
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->post_title }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" rows="10" id="description" name="description">{{ $post->post_body }}</textarea>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection


@section('extra-js')

@endsection