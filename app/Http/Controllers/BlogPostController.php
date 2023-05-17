<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::all();
        $blogs = BlogPost::all();
        // check if user is admin
        if ($user->isAdmin == 'true') {
            return view('home', [
                'user' => $user,
                'posts' => $blogs,
                'users' => $users,
                'blogs' => $blogs
            ]);
        }
        return view('blog.index', ['posts' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);

        return redirect('blog/' . $newPost->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        $comments = Comment::where('post_id', $blogPost->id)->get();
        $user = auth()->user();
        return view('blog.show', [
            'user' => $user,
            'post' => $blogPost,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $user = auth()->user();
        return view('blog.edit', [
            'user' => $user,
            'post' => $blogPost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('blog/' . $blogPost->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        $user = auth()->user();
        if ($user->isAdmin == 'true') {
            return redirect('/home');
        }
        return redirect('/blog');
    }
}
