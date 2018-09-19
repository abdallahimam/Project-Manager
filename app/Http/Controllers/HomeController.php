<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // if user is admin show dashboard of admin else show normal dashboard
        if (auth()->user()->role_id == 1){

            $companies_number = Company::withTrashed()->count();
            $projects_number = Project::withTrashed()->count();
            $tasks_number = Task::withTrashed()->count();
            $users_number = User::withTrashed()->count();

            $users = User::withTrashed()->get();
            $companies = Company::withTrashed()->get();
            $projects = Project::withTrashed()->get();
            $tasks = Task::withTrashed()->get();

            return view('layouts.dashboard', [
                'companies_number'  => $companies_number,
                'projects_number'   => $projects_number,
                'tasks_number'      => $tasks_number,
                'users_number'      => $users_number,
                'users'             => $users,
                'companies'         => $companies,
                'projects'          => $projects,
                'tasks'             => $tasks]);
        } else {

            $companies_number = Company::withTrashed()->where('id', auth()->user()->id)->count();
            $projects_number = Project::withTrashed()->where('id', auth()->user()->id)->count();
            $tasks_number = Task::withTrashed()->where('id', auth()->user()->id)->count();
            $users_number = User::withTrashed()->whereIn('id', Company::withTrashed()->where('user_id', auth()->user()->id)->get(['user_id']))->count();

            $users = User::withTrashed()->whereIn('id', Company::withTrashed()->where('user_id', auth()->user()->id)->get(['user_id']))->get();
            $companies = Company::withTrashed()->where('user_id', auth()->user()->id)->get();
            $projects = Project::withTrashed()->where('user_id', auth()->user()->id)->get();
            $tasks = Task::withTrashed()->where('user_id', auth()->user()->id)->get();

            return view('users.dashboard', [
                'companies_number'  => $companies_number,
                'projects_number'   => $projects_number,
                'tasks_number'      => $tasks_number,
                'users_number'      => $users_number,
                'users'             => $users,
                'companies'         => $companies,
                'projects'          => $projects,
                'tasks'             => $tasks]);
        }
    }

    public function settings() {
        return view('layouts.settings');
    }

    public function help() {
        return view('layouts.help');
    }
}
