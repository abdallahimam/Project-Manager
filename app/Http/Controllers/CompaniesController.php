<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
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
        $company = Company::find($company->id);
        return view('companies.edit', ['company' => $company]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // delete the company
        $findCompany = Company::find($company->id);
        if ($findCompany->delete()) {
            return redirect()->route('companies.index')->with('success', ['Company deleted succussfully.']);
        }
        return back()->withInput()->with('error', ['Can\'t delete company.']);
    }

    public function addUser(Request $request)
    {
        // this is the function to add user to company
        $company = Company::find($request->input('company_id'));
        if (Auth::user()->id == $company->user_id) {
            $employer = User::where('email', $request->input('member'))->first();
            if (!$employer) {
                return back()->withInput()->with('errors', ['User not exists.']);
            }
            $exist = User::where('work_at', $company->id)->first();
            if ($exist) {
                return back()->withInput()->with('errors', ['User is already in the company.']);
            }
            if ($employer && $company) {
                $company->employers()->save($employer);
                return back()->withInput()->with('success', 'Employer Added Successfully.');
            }
            return back()->withInput()->with('errors', ['Failed to add the employer.']);
        }
        return back()->withInput()->with('errors', ['You are nor the creator of the company.']);
    }
}
