<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectUser;
use App\User;
use App\Task;
use App\Company;
use App\File;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all projects
        if (Auth::check()) {
            $projects = Project::where('user_id', Auth::user()->id)->get();
            return view('projects.index', ['projects' => $projects]);
        }
        return view('auth.login')->with('errors', ['You should login to see your projects.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if ($company_id != null) {
            $companies = Company::where('user_id', Auth::user()->id)->get();
            // return view create Project
            return view('projects.create', ['company_id' => $company_id, 'companies' => $companies]);
        } else {
            // return view create Company as no registered company for this user.
            return redirect('companies')->with('errors', ['You have to choose company firstly that you want to assign project to it.']);
        }
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
        $company = Company::find($request->input('company_id'));
        if ($company != null) {
            if (auth()->user()->role_id == 1 || $company->user_id == auth()->user->id) {
                if (Auth::check()) {
                    // create the project record or object and save the project to the database.
                    $project = Project::create([
                        'name' => $request->input('name'),
                        'description' => $request->input('description'),
                        'user_id' => Auth::user()->id,
                        'days' => $request->input('days'),
                        'company_id' => $request->input('company_id')
                    ]);

                    if ($request->has('files')) {
                        $files = $request->file('files');
                        $i = 0;
                        foreach ($files as $file) {
                            # code...
                            $realname = $file->getClientOriginalName();
                            $extension = $file->getClientOriginalExtension();
                            $size = $file->getSize();
                            $mime = $file->getMimeType();
                            $fakename = auth()->user()->id . '_image_' . $i++ . '_' . time() . '.' . $extension;
                            Storage::makeDirectory('images/' . $project->id);
                            $newname = $file->store('images/' . $project->id);
                            $upload_file = File::create([
                                'user_id' => auth()->user()->id,
                                'project_id' => $project->id,
                                'realname' => $realname,
                                'extension' =>$extension,
                                'size' => $size,
                                'mime' => $mime,
                                'path' => $newname,
                            ]);
                        }
                    }
                    // now the response
                    if ($project) {
                        $comments = $project->comments;
                        return redirect()->route('projects.show', ['project' => $project, 'comments' => $comments])->with('success', 'Project Created Successfully.');
                    }
                    return back()->withInput()->with('errors', ['Can\'t create new project.']);
                }
                return back()->withInput()->with('errors', ['To Create New Project, You Must login First.']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        $project = Project::where('id', $project->id)->first();
        $comments = $project->comments;
        return view('projects.show', ['project' => $project, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // retrive the project data from database then pass it through the view edit
        if (auth()->user()->role_id == 1 || $project->user_id == auth()->user->id) {
            $project = Project::find($project->id);
            return view('projects.edit', ['project' => $project]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        if (auth()->user()->role_id == 1 || $project->user_id == auth()->user->id) {
            if ($request->has('delete')) {
                if ($request->has('files_id')) {
                    if (count($request->input('files_id')) > 0) {
                        foreach ($request->input('files_id') as $file_id) {
                            # code...
                            $file = File::find($file_id);
                            if ($file) {
                                Storage::delete($file->path);
                                $file->forceDelete();
                            }
                        }
                        return back()->with('success', 'Files are successfully deleted.');
                    }
                }
                return back()->with('errors', ['Select files to deleted.']);
            }
            /////////////////////// need to implement
            $updatedProject = Project::where('id', $project->id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'days' => $request->input('days')
            ]);
            
            if ($request->has('files')) {
                $files = $request->file('files');
                if ($files) {
                    $i = 0;
                    foreach ($files as $file) {
                        # code...
                        $realname = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $size = $file->getSize();
                        $mime = $file->getMimeType();
                        $fakename = auth()->user()->id . '_image_' . $i++ . '_' . time() . '.' . $extension;
                        Storage::makeDirectory('images/' . $project->id);
                        $newname = $file->store('images/' . $project->id);
                        $upload_file = File::create([
                            'user_id' => auth()->user()->id,
                            'project_id' => $project->id,
                            'realname' => $realname,
                            'extension' =>$extension,
                            'size' => $size,
                            'mime' => $mime,
                            'path' => $newname,
                        ]);
                    }
                }
            }
            if ($updatedProject) {
                $comments = $project->comments;
                return redirect()->route('projects.show', ['project' => $project->id, 'comments' => $comments])->with('success', 'Project updated successfully.');
            }
            return back()->withInput()->with('error', ['Project was not updated successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // delete the project
        if (auth()->user()->role_id == 1 || $project->user_id == auth()->user->id) {
            $findProject = Project::find($project->id);
            if ($findProject->delete()) {
                return redirect()->route('projects.index')->with('success', ['Project deleted succussfully.']);
            }
            return back()->withInput()->with('error', ['Can\'t delete project.']);
        }
    }

    public function delete(Request $request)
    {
        //
        $project = Project::find($request->input('project_id'));
        if ((auth()->user()->role_id == 1 || $project->user_id == auth()->user()->id) && $project != null) {
            if (Project::where('id', $project->id)->delete()) {
                if (Task::where('project_id', $project->id)) {
                    if (Task::where('project_id', $project->id)->delete()) {
                        return back()->with('success', 'Project is moved to trash');
                    }
                    return back()->with('success', 'Project is moved to trash');
                } else {
                    Project::where('id', $project->id)->restore();
                }
            }
        }
        return back()->with('errors', ['Project failed to move to trash']);
    }

    public function restore(Request $request)
    {
        //
        $project = Project::find($request->input('project_id'));
        if ((auth()->user()->role_id == 1 || $project->user_id == auth()->user()->id) && $project == null) {
            $deleted = Project::withTrashed()->find($request->input('project_id'));
            if ($deleted) {
                if (Company::find($deleted->company_id)) {
                    Project::where('id', $deleted->id)->restore();
                    Task::where('project_id', $deleted->id)->restore();
                    return back()->with('success', 'Project is restored from trash');
                }
            }
            return back()->with('errors', ['Project failed to restored from trash']);
        }
    }

    public function force_delete(Request $request)
    {
        //
        $project = Project::withTrashed()->find($request->input('project_id'));
        if ((auth()->user()->role_id == 1 || $project->user_id == auth()->user()->id) && $project != null) {
            Project::where('id', $project->id)->forceDelete();
            Task::where('project_id', $deleted->id)->forceDelete();
            return back()->with('success', 'User is permenantly deleted');
        }
        return back()->with('errors', ['User failed to move to trash']);

    }

    public function addUser(Request $request)
    {
        // this is the function to add user to project
        $project = Project::find($request->input('project_id'));
        if (auth()->user()->role_id == 1 || $project->user_id == auth()->user->id) {
            if (Auth::user()->id == $project->user_id) {
                $employer = User::where('email', $request->input('member'))->first();
                if (!$employer) {
                    return back()->withInput()->with('errors', ['User not exists.']);
                }
                $projectUser = ProjectUser::where('user_id', $employer->id)->where('project_id', $project->id)->first();
                if ($projectUser) {
                    return back()->withInput()->with('errors', ['User is alreasy in this project.']);
                }
                if ($employer && $project) {
                    $project->employers()->attach($employer->id);
                    return back()->withInput()->with('success', 'Employer Added Successfully.');
                }
                return back()->withInput()->with('errors', ['Failed to add the employer.']);
            }
            return back()->withInput()->with('errors', ['You are nor the creator of the project.']);
        }
    }
}
