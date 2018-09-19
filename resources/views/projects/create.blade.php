@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-9">
                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if($company_id != null)
                    <input class="form-control" type="hidden" name="company_id" value="{{ $company_id }}" />
                    @endif
                    <div class="form-group">
                        <label for="project-name">Name<span class="requied p-1 font-weight-bold text-danger bolder">*</span></label>
                        <input type="text" name="name" id="project-name" class="form-control" placeholder="Enter name" spellcheck="false" required />
                    </div>
                    @if($companies != null)
                    <div class="form-group">
                        <label for="company-name">Select Company<span class="requied p-1 font-weight-bold text-danger bolder">*</span></label>
                        <select name="company_id" id="company-name" class="form-control" required>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project-files">Project Files:</label>
                                <input type="file" name="files[]" id="project-files" class="form-control" multiple="yes" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project-duration">Days</label>
                                <input type="number" name="days" id="project-duration" min="1" class="form-control p-2" placeholder="Enter Number of Days"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project-description">Description</label>
                        <textarea name="description" id="project-description" class="form-control" placeholder="Enter description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Create project</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/companies"><i class="fa fa-building"></i> My Companies</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My projects</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection