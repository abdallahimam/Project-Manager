@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-9">
                <form action="{{ route('tasks.store') }}" method="POST">
                    {{ csrf_field() }}
                    @if($company_id != null)
                    <input class="form-control" type="hidden" name="company_id" value="{{ $company_id }}" />
                    @endif
                    @if($project_id != null)
                    <input class="form-control" type="hidden" name="project_id" value="{{ $project_id }}" />
                    @endif
                    <div class="form-group">
                        <label for="task-name">Name<span class="requied p-1 font-weight-bold text-danger bolder">*</span></label>
                        <input type="text" name="name" id="task-name" class="form-control" placeholder="Enter name" spellcheck="false" required />
                    </div>
                    @if($projects != null)
                    <div class="form-group">
                        <label for="project-name">Select Project<span class="requied p-1 font-weight-bold text-danger bolder">*</span></label>
                        <select name="project_id" id="project-name" class="form-control" required>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="task-description">Description</label>
                        <textarea name="description" id="task-description" class="form-control" placeholder="Enter description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="task-duration-days">Days</label>
                        <input type="number" name="days" id="task-duration-days" min="1" class="form-control" placeholder="Enter Number of Days" />
                    </div>
                    <div class="form-group">
                        <label for="task-duration-hours">Hours</label>
                        <input type="number" name="hours" id="task-duration-hours" min="0" max="24" class="form-control" placeholder="Enter Number of Hours" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Create task</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/tasks"><i class="fa fa-tasks"></i> My tasks</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My projocts</a></li>
                        <li><a href="/companies"><i class="fa fa-building"></i> My companies</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection