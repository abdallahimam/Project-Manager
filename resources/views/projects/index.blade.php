
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card bg-light">
                <div class="card-header text-secondary">
                    <span class="mb-0 h4">Projects</span>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($projects as $project)
                        <li class="list-group-item"><a href="projects/{{ $project->id }}"><i class="fa fa-briefcase"></i> {{ $project->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="row justify-content-center">
                <a href="/projects/create" class="col-md-4 btn btn-sm btn-group-sm btn-primary pull-right"><i class="fa fa-plus"></i> Create New Project</a>
            </div>
        </div>
        
    </div>
</div>
@endsection