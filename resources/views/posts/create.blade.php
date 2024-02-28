@extends('layouts.posts')

@section('content')
    <br>

    <div class="row postTitle">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>CREATE POST</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-light btn-sm postButton postButtonTable" href="{{ route('post') }}">BACK</a>
            </div>
        </div>
    </div>

    <br>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('postStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="mb-3 row">
                <label for="title" class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                    <input required type="text" id='title' placeholder="Title" class="form-control registerInput" name="title">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="title" class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-9">
                    <textarea id="content" name="content" rows="10" class="form-control registerInput" placeholder="Add your content..." required></textarea>
                    @error('content')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="mb-3 row text-center">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-light btn-lg postButton">CREATE</button>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
    </form>

    <br>
@endsection
