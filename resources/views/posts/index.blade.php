@extends('layouts.posts')

@section('content')
    <br>
    <div class="row postTitle">
        <div class="col-sm-6">
            WELCOME
            @php
                echo strtoupper(Auth::user()->first_name .' '. Auth::user()->last_name);
            @endphp
        </div>
        <div class="col-sm-6 text-end">
            <a href="{{ route('logout') }}" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #5AC8E0">LOG OUT</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" >
                @csrf
            </form>
        </div>
    </div>

    <br>

    <div>
        <a class="btn btn-light btn-sm postButton" href="{{ route('postCreate') }}">CREATE POST</a>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-dark">
            <thead class="text-center">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $post)
                    <tr>
                        <th scope="row">{{ $posts->firstItem() + $key }}</th>
                        <td class="shortTitle">{{ $post->title }}</td>
                        <td>{{ $post->user->getFullName() }}</td>
                        <td class="text-center">
                            <form action="{{ route('postDelete', $post->id) }}" method="Post">
                                <a class="btn btn-light btn-sm postButton postButtonTable" href="{{ route('postShow', $post->id) }}">VIEW</a>
                                <a class="btn btn-light btn-sm postButton postButtonTable" href="{{ route('postEdit', $post->id) }}">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm postButton postButtonTable">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>

    <div class="postPagination">
        {{ $posts->links() }}
    </div>

@endsection
