@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
                <form action="{{ route('companies.update', [$company->id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="form-group">
                        <label for="company-name">Name<span class="requied p-1 font-weight-bold text-danger">*</span></label>
                        <input type="text" name="name" id="company-name" class="form-control" value="{{ $company->name }}" placeholder="Enter name" spellcheck="false" required />
                    </div>
                    <div class="form-group">
                        <label for="company-description">Description</label>
                        <textarea name="description" id="company-description" class="form-control" placeholder="Enter description" rows="4">
                            {{ $company->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Update company</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/companies/{{ $company->id }}"><i class="fa fa-building-o"></i> View company</a></li>
                        <li><a href="/companies"><i class="fa fa-building"></i> My Companies</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection