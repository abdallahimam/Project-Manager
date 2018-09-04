@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
                <!-- Main jumbotron for a primary marketing message or call to action -->
                <div class="jumbotron mt-0">
                    <div class="container">
                        <h1 class="display-3 mb-1">{{ $company->name }}</h1>
                        <hr class="m-0 mb-1" />
                        <hr class="m-0 mb-1" />
                        <p class="lead mb-1 ">{{ $company->description }}</p>
                        <hr class="m-0 mb-1" />
                        <p><a class="btn btn-primary btn-lg mt-2" href="#" role="button">Learn more »</a></p>
                    </div>
                </div>
                <div class="container">
                    <!-- Example row of columns -->
                    <div class="row">
                        @foreach($company->projects as $project)
                        <div class="col-md-4">
                            <h2>{{ $project->name }}</h2>
                            <hr class="m-0 mb-1" />
                            <hr class="m-0 mb-1" />
                            <p class="lead mb-1 text-truncate">{{ $project->description }}</p>
                            <hr class="m-0 mb-1" />
                            <p><a class="btn btn-secondary mt-2" href="/projects/{{ $project->id }}" role="button">View Project »</a></p>
                        </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-end">
                        <a href="/projects/create/{{ $company->id }}" class="btn btn-primary btn-sm col-md-2"><i class="fa fa-plus"></i> Add Project</a>
                    </div>
                    <br />
                    <div class="add-comment">
                        <div class="card">
                            <div class="card-header">
                                Add Comment...
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="commentable_type" value="App\Company" />
                                        <input type="hidden" name="commentable_id" value="{{ $company->id }}" />
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
                </div> <!-- /container -->
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="about">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-italic">About</h4>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-italic">Actions</h4>
                        </div>
                        <div class="card-body">
                            <ol class="list-unstyled">
                                <li><a href="/companies/{{ $company->id }}/edit"><i class="fa fa-edit"></i> Edit</a></li>
                                <li><a href="/projects/create/{{ $company->id }}"><i class="fa fa-plus"></i> Add Project</a></li>
                                <li><a href="/companies/create"><i class="fa fa-plus"></i> New Company</a></li>
                                <li><a href="/companies"><i class="fa fa-building"></i> My Companies</a></li>
                                <hr class="mt-1 mb-1 bg-info" />
                                @if($company->user_id == Auth::user()->id)
                                <li>
                                    <a href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('delete-form').submit(); }"><i class="fa fa-remove"></i> Delete</a>
                                    <form id="delete-form" class="d-none hidden" action="{{ route('companies.destroy', [$company->id]) }}" method="post">
                                        <input type="hidden" name="_method" value="delete" />
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="members">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-italic">Members</h4>
                        </div>
                        <div class="card-body">
                            @if($company->user_id == Auth::user()->id)
                            <form id ="add-user" action="{{ route('companies.adduser') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group mb-2">
                                <input type="hidden" name="company_id" value="{{ $company->id }}" />
                                    <input type="text" name="member" id="member-id" class="form-control" placeholder="Email" required />
                                    <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-user-plus"></i></button></span>
                                </div>
                            </form>
                            @endif
                            <ol class="list-unstyled mb-0">
                            @foreach($company->employers as $employer)
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