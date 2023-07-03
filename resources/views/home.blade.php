@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .dataTable {
            padding-top: 2rem;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-4"></div>
            <div class="col-4"></div>
            <div class="col-4 text-end">
                <a href="{{ route('post-create') }}" class="btn btn-primary btn-sm">Create post</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $post->post_title }}</td>
                        <td>{{ $post->post_body }}</td>
                        <td>
                            <a href="{{ url('post/view/'.$post->id) }}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{ url('post/delete/'.$post->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('extra-js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        let table = new DataTable('.table');
    </script>
@endsection