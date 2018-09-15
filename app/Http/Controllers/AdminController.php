<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

use App\Jobs\SendMailJob;
use Carbon\Carbon;

class AdminController extends Controller
{
    //

    public function get_all_companies() {
        $all_companies = Company::all();
        return view('companies.index', ['companies' => $all_companies]);
    }

    public function get_all_projects() {
        $all_projects = Project::all();
        return view('projects.index', ['projects' => $all_projects]);
    }

    public function get_all_tasks() {
        $all_tasks = Task::all();
        return view('tasks.index', ['tasks' => $all_tasks]);
    }

    public function send_mail() {
        $job = (new SendMailJob())->delay(Carbot::now()->addSeconds(30));
        dispatch($job);
        return redirect('/dashboard')->with('success', 'Email is sent successfully to \'test@test.com\'.');
    }
}
