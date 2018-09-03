@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
                <form action="{{ route('tasks.update', [$task->id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="form-group">
                        <label for="task-name">Name<span class="requied p-1 font-weight-bold text-danger">*</span></label>
                        <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}" placeholder="Enter name" spellcheck="false" required />
                    </div>
                    <div class="form-group">
                        <label for="task-description">Description</label>
                        <textarea name="description" id="task-description" class="form-control" placeholder="Enter description" rows="4">
                            {{ $task->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="task-duration-days">Days</label>
                        <input type="number" name="days" value="{{ $task->days }}" id="task-duration-days" min="1" class="form-control" placeholder="Enter Number of Days" />
                    </div>
                    <div class="form-group">
                        <label for="task-duration-hours">Hours</label>
                        <input type="number" name="hours" value="{{ $task->hours }}" id="task-duration-hours" min="0" max="24" class="form-control" placeholder="Enter Number of Hours" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Update task</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3">
                    <h4 class="font-italic">Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="/tasks/{{ $task->id }}"><i class="fa fa-eye"></i>View task</a></li>
                        <li><a href="/tasks"><i class="fa fa-tasks"></i> My tasks</a></li>
                        <li><a href="/projects"><i class="fa fa-briefcase"></i> My projocts</a></li>
                        <li><a href="/companies"><i class="fa fa-building"></i> My companies</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection