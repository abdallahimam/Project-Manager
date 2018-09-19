<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\Task;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all companies
        if (Auth::check()) {
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('companies.index', ['companies' => $companies]);
        }
        return view('auth.login')->with('errors', ['You should login to see your companies.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view create company
        return view('companies.create');
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
        if (Auth::check()) {
            // create the company record or object and save the company to the database.
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);
            // now the response
            if ($company) {
                $comments = $company->comments;
                return redirect()->route('companies.show', ['company' => $company, 'comments' => $comments])->with('success', 'Company Created Successfully.');
            }
            return back()->withInput()->with('errors', ['Can\'t create new company.']);
        }
        return back()->withInput()->with('errors', ['To Create New Company, You Must login First.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
        $company = Company::where('id', $company->id)->first();
        $comments = $company->comments;
        return view('companies.show', ['company' => $company, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // retrive the company data from database then pass it through the view edit
        if (auth()->user()->role_id == 1 || $company->user_id == auth()->user->id) {
            $company = Company::find($company->id);
            return view('companies.edit', ['company' => $company]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
        if (auth()->user()->role_id == 1 || $company->user_id == auth()->user->id) {
            $updatedCompany = Company::where('id', $company->id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

            if ($updatedCompany) {
                $comments = $company->commetns;
                return redirect()->route('companies.show', ['company' => $company->id, 'comments' => $comments])->with('success', 'Comapny updated successfully.');
            }

            return back()->withInput()->with('error', ['Comapny was not updated successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // delete the company
        if ((auth()->user()->role_id == 1 || $company->user_id == auth()->user()->id) && $company != null) {
            if (Company::where('id', $company->id)->delete()) {
                if (Project::where('company_id', $company->id)->count() != 0) {
                    if (Project::where('company_id', $company->id)->delete()) {
                        if (Task::where('company_id', $company->id)->count() != 0) {
                            if (Task::where('company_id', $company->id)->delete()) {
                                return redirect('/companies')->with('success', 'Company is move to trash');
                            }
                        } else {
                            return redirect('/companies')->with('success', 'Company is move to trash');
                        }
                    }
                } else {
                    return redirect('/companies')->with('success', 'Company is move to trash');
                }
            }
            Company::where('id', $company->id)->restore();
            Project::where('company_id', $company->id)->restore();
            return back()->with('errors', ['Company failed to move to trash']);
        }
    }

    public function addUser(Request $request)
    {
        // this is the function to add user to company
        $company = Company::find($request->input('company_id'));
        if (auth()->user()->role_id == 1 || $company->user_id == auth()->user->id) {
            if (Auth::user()->id == $company->user_id) {
                $employer = User::where('email', $request->input('member'))->first();
                if (!$employer) {
                    return back()->withInput()->with('errors', ['User not exists.']);
                } else if ($employer->work_at != null) {
                    $exist = User::where('work_at', $company->id)->first();
                    if ($exist) {
                        return back()->withInput()->with('errors', ['User is already in the company.']);
                    } else {
                        return back()->withInput()->with('errors', ['User is already registered in other the company.']);
                    }
                } else {
                    if ($employer && $company) {
                        $company->employers()->save($employer);
                        return back()->withInput()->with('success', 'Employer Added Successfully.');
                    }
                }
                return back()->withInput()->with('errors', ['Failed to add the employer.']);
            }
            return back()->withInput()->with('errors', ['You are nor the creator of the company.']);
        }
    }

    public function delete(Request $request)
    {
        //
        $company = Company::find($request->input('company_id'));
        if ((auth()->user()->role_id == 1 || $company->user_id == auth()->user()->id) && $company != null) {
            if (Company::where('id', $company->id)->delete()) {
                if (Project::where('company_id', $company->id)->count() != 0) {
                    if (Project::where('company_id', $company->id)->delete()) {
                        if (Task::where('company_id', $company->id)->count() != 0) {
                            if (Task::where('company_id', $company->id)->delete()) {
                                return redirect('/companies')->with('success', 'Company is move to trash');
                            }
                        } else {
                            return redirect('/companies')->with('success', 'Company is move to trash');
                        }
                    }
                } else {
                    return redirect('/companies')->with('success', 'Company is move to trash');
                }
            }
            Company::where('id', $company->id)->restore();
            Project::where('company_id', $company->id)->restore();
            return back()->with('errors', ['Company failed to move to trash']);
        }
    }

    public function restore(Request $request)
    {
        //
        $company = Company::find($request->input('company_id'));
        if ((auth()->user()->role_id == 1 || $company->user_id == auth()->user()->id) && $company == null) {
            $deleted = Company::withTrashed()->find($request->input('company_id'));
            if ($deleted) {
                Company::where('id', $deleted->id)->restore();
                Project::where('company_id', $deleted->id)->restore();
                Task::where('company_id', $deleted->id)->restore();
                return back()->with('success', 'Company is restored from trash');
            }
            return back()->with('errors', ['Comany failed to restored from trash']);
        }
    }

    public function force_delete(Request $request)
    {
        //
        $company = Company::withTrashed()->find($request->input('company_id'));
        if ((auth()->user()->role_id == 1 || $company->user_id == auth()->user()->id) && $company != null) {
            Company::where('id', $company->id)->forceDelete();
            Project::where('company_id', $company->id)->forceDelete();
            Task::where('company_id', $company->id)->forceDelete();
            return back()->with('success', 'Company is permenantly deleted');
        }
        return back()->with('errors', ['Company failed to move to trash']);
    }
}
