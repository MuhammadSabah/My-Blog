@extends('layouts.app')

@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                @if($user->isAdmin == 'false')
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>This awesome blog has many articles, click the button below to see them</p>
                <br>
                <a href="/blog" class="btn btn-outline-primary">Show Blog</a>
                @else

                <div class="px-5">
                    <h2><strong>Users</strong></h2>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">User Email</th>
                                <th scope="col">User Phone Number</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phoneNo}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td class="d-flex gap-1">
                                    @if($user->isAdmin == 'false')
                                    <a href="/profile/{{$user->id}}" class="btn btn-primary">View</a>
                                    <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{$user->id}}"></input>
                                        <button class="btn btn-danger ">Delete</button>
                                    </form>
                                    @else
                                    <div></div>
                                    @endif
                                </td>
                                @empty
                                <p class="text-warning">No users available!</p>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-5 mt-lg-5">
                    <h2><strong>Blog Posts</strong></h2>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Author ID</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                            <tr>
                                <th scope="row">{{$blog->id}}</th>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->user_id}}</td>
                                <td>{{$blog->created_at}}</td>
                                <td>{{$blog->updated_at}}</td>
                                <td class="d-flex gap-1">
                                    <a href="/blog/{{$blog->id}}" class="btn btn-primary">View</a>
                                    <!-- <form action="" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="blog_id" id="blog_id" value="{{$blog->id}}"></input>
                                        <button class="btn btn-danger ">Delete</button>
                                    </form> -->
                                    <a href="/blog/{{$blog->id}}/edit" class="btn btn-warning ">Edit</a>
                                </td>
                                @empty
                                <p class="text-warning">No users available!</p>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection