@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
                <!-- Main jumbotron for a primary marketing message or call to action -->
                <div class="jumbotron mt-0 pt-5 mb-2 bg-info text-dark">
                    <h1 class="m-0 mb-1">Company name: {{ $project->company->name }}</h1>
                    <hr class="m-0 mb-1" />
                    <hr class="m-0 mb-1" />
                    <h3 class="m-0 mb-1">Project name: {{ $project->name }}</h3>
                    <hr class="m-0 mb-1" />
                    <p class="lead mb-1">{{ $project->description }}</p>
                    <hr class="m-0 mb-1" />
                    <p class="lead">Project duration: <strong class="text-dark">{{ $project->days }}</strong> days.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
                </div>
                <div class="tasks">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-8"><span class="text-lg-right">List of tasks.</span></div>
                                <div class="col-sm-4 text-right"><span class="text-sm-right text-info text-right pr-5">{{ @count($project->tasks )}}</span></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            @foreach($project->tasks as $task)
                                <div class="col-md-4">
                                    <h2>{{ $task->name }}</h2>
                                    <hr class="m-0 mb-1" />
                                    <hr class="m-0 mb-1" />
                                    <p class="lead text-truncate">{{ $task->description }}</p>
                                    <hr class="m-0 mb-1" />
                                    <p><a class="btn btn-secondary mt-2" href="/tasks/{{ $task->id }}" role="button">View Task »</a></p>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <a href="/tasks/create" class="col-md-4 btn btn-sm btn-group-sm btn-primary pull-right">Add Task</a>
                    </div>
                </div>
                <br/>
                <div class="add-comment">
                    <div class="card">
                        <div class="card-header">
                            Add Comment...
                        </div>
                        <div class="card-body">
                            <div class="form">
                                <form action="{{ route('comments.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="commentable_type" value="App\Project" />
                                    <input type="hidden" name="commentable_id" value="{{ $project->id }}" />
                                    <div class="form-group">
                                        <label for="comment-content">Comment<span class="requied p-1 font-weight-bold text-danger">*</span></label>
                                        <textarea name="comment" id="comment-content" class="form-control" placeholder="Enter comment" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment-url">Proof of done work(url/photos)<span class="requied p-1 font-weight-bold text-danger">*</span></label>
                                        <textarea name="url" id="comment-url" class="form-control" placeholder="Enter proofs (photos/url)" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mb-2">Submit comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- include your comments -->
                @include('partials.comments')
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">About</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/projects/{{ $project->id }}/edit"><i class="fa fa-edit"></i> Edit</a></li>
                        <li><a href="/tasks/create/{{ $project->id }}"><i class="fa fa-plus"></i> Add Task</a></li>
                        <li><a href="/projects/create/{{ $project->company_id }}"><i class="fa fa-plus"></i> New Project</a></li>
                        <li><a href="/companies/create"><i class="fa fa-plus"></i> New Company</a></li>
                        <li><a href="/companies"><i class="fa fa-building"></i> My Companies</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My projects</a></li>
                        <hr class="mt-1 mb-1" />
                        @if($project->user_id == Auth::user()->id)
                        <li>
                            <a href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('delete-form').submit(); }">Delete</a>
                            <form id="delete-form" class="d-none hidden" action="{{ route('projects.destroy', [$project->id]) }}" method="post">
                                <input type="hidden" name="_method" value="delete" />
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endif
                    </ol>
                </div>
                <div class="members">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-italic">Members</h4>
                        </div>
                        <div class="card-body">
                            @if($project->user_id == Auth::user()->id)
                            <form id ="add-user" action="{{ route('projects.adduser') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group mb-2">
                                <input type="hidden" name="project_id" value="{{ $project->id }}" />
                                    <input type="text" name="member" id="member-id" class="form-control" placeholder="E-mail" />
                                    <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-user-plus"></i></button></span>
                                </div>
                            </form>
                            @endif
                            <ol class="list-unstyled mb-0">
                            @foreach($project->employers as $employer)
                                <li><a href="#">{{ $employer->name }}</a></li>
                            @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection