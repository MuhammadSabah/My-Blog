<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $viewed_user = $user->where('id', $user->id)->get();
        $user = auth()->user();
        return view('account.profile', ['user' => $viewed_user[0], 'auth_user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // if ($request->type == 'update') {
        //     $user->update([
        //         'name' => $request->name,
        //         'email' => $request->email,

        //     ]);

        //     return redirect('profile/' . $user->id);
        // }
        $image = $request->file('image');
        $path = $image->move("public/uploads", $image->getClientOriginalName());

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phoneNo' => $request->phoneNo,
            'imageUrl' => $path
        ]);

        return redirect('profile/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Request $request)
    {
        $user->where('id', $request->id)->delete();
        $user = auth()->user();
        if ($user->isAdmin == 'true') {
            return redirect('/home');
        }
        return redirect('/blog');
    }
}
