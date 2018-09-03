<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all tasks
        if (Auth::check()) {
            $tasks = Task::where('user_id', Auth::user()->id)->get();
            return view('tasks.index', ['tasks' => $tasks]);
        }
        return view('auth.login')->with('errors', ['You should login to see your tasks.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id = null)
    {
        $companies = null;
        $tasks = null;
        $company_id = null;
        if (!$project_id) {
            $projects = Project::where('user_id', Auth::user()->id)->get();
        } else {
            $project = Project::Where('id', $project_id)->first();
            $company_id = $project['company_id'];
        }
        // return view create task
        return view('tasks.create', ['company_id' => $company_id, 'project_id' => $project_id, 'projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            // create the company record or object and save the company to the database.
            $company_id = $request->input('company_id');
            if (!$company_id) {
                $project = Project::where('id', $request->input('project_id'))->first();
                $company_id = $project->company_id;
            }
            $task = Task::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'days' => $request->input('days'),
                'hours' => $request->input('hours'),
                'user_id' => Auth::user()->id,
                'company_id' => $company_id,
                'project_id' => $request->input('project_id')
            ]);
            // now the response
            if ($task) {
                $comments = $task->comments;
                return redirect()->route('tasks.show', ['task' => $task, 'comments' => $comments])->with('success', 'Task Created Successfully.');
            }
            return back()->withInput()->with('errors', ['Can\'t create new task.']);
        }
        return back()->withInput()->with('errors', ['To Create New Task, You Must login First.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
        $task = Task::where('id', $task->id)->first();
        $comments = $task->comments;
        return view('tasks.show', ['task' => $task, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        $task = Task::find($task->id);
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $updatedTask = Task::where('id', $task->id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'days' => $request->input('days'),
            'hours' => $request->input('hours'),
        ]);

        if ($updatedTask) {
            $comments = $task->comments;
            return redirect()->route('tasks.show', ['task' => $task->id, 'comments' => $comments])->with('success', 'Task updated successfully.');
        }

        return back()->withInput()->with('error', ['Task was not updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $findTask = Company::find($task->id);
        if ($findTask->delete()) {
            return redirect()->route('tasks.index')->with('success', ['Task deleted succussfully.']);
        }
        return back()->withInput()->with('error', ['Can\'t delete task.']);
    }

    public function addUser(Request $request)
    {
        // this is the function to add user to task
        $task = Task::find($request->input('task_id'));
        if (Auth::user()->id == $task->user_id) {
            $employer = User::where('email', $request->input('member'))->first();
            $taskUser = TaskUser::where('user_id', $employer->id)->where('task_id', $task->id)->first();
            if ($taskUser) {
                return back()->withInput()->with('errors', ['User is alreasy in this task.']);
            }
            if ($employer && $task) {
                $task->employers()->attach($employer->id);
                return back()->withInput()->with('success', 'Employer Added Successfully.');
            }
            return back()->withInput()->with('errors', ['Failed to add the employer.']);
        }
        return back()->withInput()->with('errors', ['You are nor the creator of the project.']);
    }
}
