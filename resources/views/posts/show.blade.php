@extends('layouts.posts')

@prepend('scripts')
    <script src="{{ asset('js/scripts.js')}}"></script>
@endpush

@section('content')
    <br>

    <div class="row postTitle">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>POST</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-light btn-sm postButton postButtonTable" href="{{ route('post') }}">BACK</a>
            </div>
        </div>
    </div>

    <br>

    <div class="card postCard">
        <div class="card-header" style="border-bottom: 0">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="card-body">
            {!! nl2br(e($post->content)) !!}
        </div>
        <div class="card-footer" style="border-top: 0">
            <small><cite title="Source Title">by: {{ $post->user->getFullName() }}</cite></small>
        </div>
    </div>

    <br>

    <div class="row postTitle">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>COMMENTS</h2>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id='commentTable' class="table table-dark">
            <tbody>
            <tr>
                <td style="width: 75%"><textarea type='text' id='comment' class="form-control registerInput" rows="2"></textarea></td>
                <td class="text-center" style="text-align: center;vertical-align: middle;"><button type='button' id='addComment' value='Add' class="btn btn-light btn-sm commentsButton">
                         ADD</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
