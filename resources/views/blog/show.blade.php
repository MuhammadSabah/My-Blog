@extends('layouts.app')
@section('content')

<div>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-0">
                @if($user->isAdmin == 'false')
                <a href="/blog" class="btn btn-outline-primary btn-sm mb-4">Go back</a>
                @else
                <a href="/home" class="btn btn-outline-primary btn-sm mb-4">Go back</a>
                @endif
                <h1 class="display-one">{{ ucfirst($post->title) }}</h1>
                <p>{!! $post->body !!}</p>
                <hr>
                @if (Auth::user()->id == $post->user_id || $user->isAdmin == 'true')
                <div class="d-flex mb-lg-5 gap-2">
                    <a href="/blog/{{ $post->id }}/edit" class="btn btn-outline-secondary">Edit Post</a>
                    <form id="delete-frm" class="" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete Post</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-start">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        <form class="form-outline mb-4 " action="" method="POST">
                            @csrf
                            <input type="text" id="text" name="text" class="form-control mb-2" placeholder="Type comment..." required />
                            <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}"></input>
                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"></input>
                            <button id="btn-submit" class="btn btn-secondary">+ Add a note</button>
                        </form>
                        @forelse($comments as $comment)
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>{{$comment->text}}</p>
                                <input type="hidden" id="user_comment_id" name="user_comment_id" value="{{$comment->user_id}}"></input>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <p class="small mb-0 ms-2">{{$comment->username}}</p>
                                    </div>
                                    <!-- <div class="d-flex flex-row align-items-center ">
                                        <button class=" btn btn-outline-secondary btn-sm  mb-0 mx-2 ">Upvote</button>
                                        <p class="small text-muted mb-0">{{$comment->likes}}</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        @empty
                        <p class="text-warning">No comments available!</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection