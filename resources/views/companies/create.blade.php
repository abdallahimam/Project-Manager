@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-9">
                <form action="{{ route('companies.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="company-name">Name<span class="requied p-1 font-weight-bold text-danger bolder">*</span></label>
                        <input type="text" name="name" id="company-name" class="form-control" placeholder="Enter name" spellcheck="false" required />
                    </div>
                    <div class="form-group">
                        <label for="company-description">Description</label>
                        <textarea name="description" id="company-description" class="form-control" placeholder="Enter description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Create company</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/companies"><i class="fa fa-building"></i> My Companies</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My Projects</a></li>
                        <li><a href="/tasks"><i class="fa fa-tasks"></i> My Tasks</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection