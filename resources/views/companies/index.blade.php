
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card bg-light">
                <div class="card-header text-secondary">
                    <span class="mb-0 h4">Companies</span>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($companies as $company)
                        <li class="list-group-item"><a href="companies/{{ $company->id }}">{{ $company->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="row justify-content-center">
                <a href="/companies/create" class="col-md-4 btn btn-sm btn-group-sm btn-primary pull-right"><i class="fa fa-plus"></i> Create New Company</a>
            </div>
        </div>
    </div>
</div>
@endsection