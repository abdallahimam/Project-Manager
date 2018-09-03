@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
                <!-- Main jumbotron for a primary marketing message or call to action -->
                <div class="jumbotron mt-0 pt-5 mb-2 bg-info text-dark">
                    <h1 class="m-0 mb-1">Company name: {{ $task->company->name }}</h1>
                    <hr class="m-0 mb-1 w-25" />
                    <hr class="m-0 mb-1 w-50" />
                    <hr class="m-0 mb-1 w-75" />
                    <h2 class="m-0 mb-1">Project name: {{ $task->project->name }}</h2>
                    <hr class="m-0 mb-1 w-25" />
                    <hr class="m-0 mb-1 w-50" />
                    <h3 class="m-0 mb-1">Task name: {{ $task->name }}</h3>
                    <hr class="m-0 mb-1" />
                    <p class="lead mb-1">{{ $task->description }}</p>
                    <hr class="m-0 mb-1" />
                    <p class="lead">Task duration: <strong class="text-dark">{{ $task->days }}</strong> days and <strong class="text-dark">{{ $task->hours }}</strong> hours.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
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
                                    <input type="hidden" name="commentable_type" value="App\Task" />
                                    <input type="hidden" name="commentable_id" value="{{ $task->id }}" />
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
                        <li><a href="/tasks/{{ $task->id }}/edit"><i class="fa fa-edit"></i> Edit</a></li>
                        <li><a href="/tasks/create/{{ $task->project_id }}"><i class="fa fa-plus"></i> Add Task</a></li>
                        <li><a href="/projects/create/{{ $task->company_id }}"><i class="fa fa-plus"></i> New Project</a></li>
                        <li><a href="/companies/create"><i class="fa fa-plus"></i> New Company</a></li>
                        <li><a href="/tasks"><i class="fa fa-tasks"></i> My tasks</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My projocts</a></li>
                        <li><a href="/companies"><i class="fa fa-building"></i> My companies</a></li>
                        <hr class="mt-1 mb-1" />
                        @if($task->user_id == Auth::user()->id)
                        <li>
                            <a href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('delete-form').submit(); }"><i class="fa fa-remove"></i> Delete</a>
                            <form id="delete-form" class="d-none hidden" action="{{ route('tasks.destroy', [$task->id]) }}" method="post">
                                <input type="hidden" name="_method" value="delete" />
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li><a href="#"><i class="fa fa-user-plus"></i> Add new member</a></li>
                        @endif
                    </ol>
                </div>
                <div class="members">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-italic">Members</h4>
                        </div>
                        <div class="card-body">
                            @if($task->user_id == Auth::user()->id)
                            <form id ="add-user" action="{{ route('tasks.adduser') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group mb-2">
                                <input type="hidden" name="task_id" value="{{ $task->id }}" />
                                    <input type="text" name="member" id="member-id" class="form-control" placeholder="E-mail" />
                                    <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-user-plus"></i></button></span>
                                </div>
                            </form>
                            @endif
                            <ol class="list-unstyled mb-0">
                            @foreach($task->employers as $employer)
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