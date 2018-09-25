<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::withTrashed()->paginate(30, ['*'], 'usersPage');
        // $trashed = User::onlyTrashed()->paginate(30, ['*'], 'trashesPage');

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // if user is null show the the registered user else show the user that is assigned
        $user = User::where('id', $user->id)->first();
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if user is null show the the registered user else show the user that is assigned
        if (auth()->user()->role_id == 1 || $user->id == auth()->user()->id) {
            $user = User::where('id', $user->id)->first();
            if ($user != null) {
                $roles = Role::all();
                return view('users.edit', ['user' => $user, 'roles' => $roles]);
            }
            return back()->with('errors', ['Invalid user.']);
        }
        return back()->with('errors', ['url not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // validate the data before updating them to database
        $request->validate([
            'fname' => 'required|max:80',
            'mname' => 'required|max:80',
            'lname' => 'required|max:95',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'postal-code' => 'required|max:6',
            'about-me' => 'required',
            'phone' => 'required|min:11|max:15',
            'password' => 'min:8|max:255|confirmed',
        ]);
        if (auth()->user()->role_id == 1 || $user->id == auth()->user()->id) {
            $updatedUser = User::where('id', $user->id)->update([
                'first_name' => $request->input('fname'),
                'middle_name' => $request->input('mname'),
                'last_name' => $request->input('lname'),
                'name' => $request->input('fname') . ' ' . $request->input('mname') . ' ' . $request->input('lname'),
                'password' => Hash::make($request->input('password')),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'postal_code' => $request->input('postal-code'),
                'phone' => $request->input('phone'),
                'about_me' => $request->input('about-me'),
                'role_id' => $request->input('role'),
            ]);
            if ($updatedUser != null) {
                return back()->withInput()->with(['success' => 'You Profile updated successfully.']);
            }
            return back()->with('errors', ['Invalid user.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if (auth()->user()->role_id == 1) {
            if ($user->id == auth()->user()->id) {
                return back()->with('errors', ['You can not delete yourself']);
            }
            $deleted = User::find(request()->input('user_id'));
            if ($deleted->delete()) {
                return back()->with('success', 'User is moved to trash');
            }
            return back()->with('errors', ['User failed to move to trash']);
        }
    }

    public function delete(Request $request)
    {
        //
        $user_id =$request->input('user_id');
        if (auth()->user()->role_id == 1 || $user_id == auth()->user()->id) {
            $deleted = User::find($user_id);
            if ($deleted->delete()) {
                return back()->with('success', 'User is moved to trash');
            }
            return back()->with('errors', ['User failed to move to trash']);
        }
    }

    public function restore(Request $request)
    {
        //
        $user_id =$request->input('user_id');
        if (auth()->user()->role_id == 1 || $user_id == auth()->user()->id) {
            $deleted = User::withTrashed()->find($user_id);
            if ($deleted) {
                User::where('id', $user_id)->restore();
                return back()->with('success', 'User is restored from trash');
            }
            return back()->with('errors', ['User failed to restored from trash']);
        }
    }

    public function force_delete(Request $request)
    {
        //
        $user_id =$request->input('user_id');
        if (auth()->user()->role_id == 1 || $user_id == auth()->user()->id) {
            $deleted = User::withTrashed()->find($user_id);
            if ($deleted) {
                User::where('id', $user_id)->forceDelete();
                return back()->with('success', 'User is permenantly deleted');
            }
            return back()->with('errors', ['User failed to move to trash']);
        }
    }

    public function deleteSelected() {
        if (auth()->user()->role_id == 1) {
            if (request()->has('id')) {
                if (request()->has('restore')) {
                    User::whereIn('id', request('id'))->restore();
                } else if (request()->has('force')) {
                    User::whereIn('id', request('id'))->forceDelete();
                } else {
                    User::destroy(request('id'));
                }
            }
            return back();
        }
    }
}
