<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('dashboard.users.index', compact('users'));
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
    public function update($id)
    {
        // dd(request());
        $user = User::findOrFail($id);
        if(request('name')!=null){
            $user->name=request('name');
        }
        if(request('email')!=null){
            $user->email=request('email');
        }
        if(request('phone')!=null){
            $user->phone=request('phone');
        }
        if(request('isAdmin')!=null){
            // dd(request());
            $user->isAdmin=request('isAdmin');
        }
        if(request()->hasFile('avatar')){
            $avatarImage = request()->file('avatar');
            $avatarImageName = time(). '.'. $avatarImage->getClientOriginalExtension();
            $path=$avatarImage->move('storage/uploads/avatar', $avatarImageName);
            $user->avatar=$path;
        }
        if(request('address')!=null){
            $user->address=request('address');
        }
        if(request('isVerified')!=null){
            $user->isVerified=request('isVerified');
        }
        $user->update();
        return back()->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
