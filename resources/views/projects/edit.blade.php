@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
                <form action="{{ route('projects.update', [$project->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="form-group">
                        <label for="project-name">Name<span class="requied p-1 font-weight-bold text-danger">*</span></label>
                        <input type="text" name="name" id="project-name" class="form-control" value="{{ $project->name }}" placeholder="Enter name" spellcheck="false" required />
                    </div>
                    @if(count($project->files) > 0)
                    <div class="project-photo bg-light">
                        <div class="form-group">
                            <label class="my-4 text-center text-lg-left">Project photos</label>
                            <div class="row text-center text-lg-left">
                                @foreach($project->files as $file)
                                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
                                    <input type="checkbox" name="files_id[]" value="{{ $file->id }}">
                                    <a href="#" class="d-block">
                                        <img class="img-fluid img-thumbnail" src="{{ asset('uploads/' . $file->path) }}" alt="{{ $file->realname }}">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="delete" class="btn btn-primary mb-2">Delete files...</button>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project-files">Uploads new files:</label>
                                <input type="file" name="files[]" id="project-files" class="form-control" multiple="yes" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project-duration">Days</label>
                                <input type="number" name="days" value="{{ $project->days }}" id="project-duration" min="1" class="form-control p-2" placeholder="Enter Number of Days"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project-description">Description</label>
                        <textarea name="description" id="project-description" class="form-control" placeholder="Enter description" rows="4">
                            {{ $project->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-primary mb-2">Update project</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/projects/{{ $project->id }}"><i class="fa fa-eye"></i>View project</a></li>
                        <li><a href="/companies"><i class="fa fa-building"></i> My Companies</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My projects</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection