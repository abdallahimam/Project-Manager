@extends('layouts.app')

@section('content')
<div class="container mt-0">
    <h2 class="sub-header mt-4">Some statistics about the website</h2>
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3">
            <div class="placeholder">
                <i class="fa fa-5x fa-building"></i>
                <h4>Companies</h4>
                <span class="text-muted">{{ $companies_number }}</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="placeholder">
                <i class="fa fa-5x fa-briefcase"></i>
                <h4>Projects</h4>
                <span class="text-muted">{{ $projects_number }}</span></div>
            </div>
        <div class="col-xs-6 col-sm-3">
            <div class="placeholder">
                <i class="fa fa-5x fa-tasks"></i>
                <h4>Tasks</h4>
                <span class="text-muted">{{ $tasks_number }}</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="placeholder">
                <i class="fa fa-5x fa-users"></i>
                <h4>Employers</h4>
                <span class="text-muted">{{ $users_number }}</span>
            </div>
        </div>
    </div>
    @if($users_number > 0)
    <h2 class="sub-header"><i class="fa fa-users mr-3"></i>Users <span class="pull-right pr-5 rounded-circle">{{ $users_number }}</span></h2>
    <div class="table-responsive table-sm">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">edit</a>
                    @if($user->deleted_at == null)
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('user-delete-form-{{$user->id}}').submit(); }">trash</a>
                    <form id="user-delete-form-{{$user->id}}" class="d-none hidden" action="{{ route('users.delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    </form>
                    @else
                    <a class="btn btn-sm btn-primary" href="#" onclick=" var result = confirm('Are you sure you want to restore?'); if (result) { event.preventDefault(); document.getElementById('user-restore-form-{{$user->id}}').submit(); }">restore</a>
                    <form id="user-restore-form-{{$user->id}}" class="d-none hidden" action="{{ route('users.restore') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    </form>
                    @endif
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete permenantaly?'); if (result) { event.preventDefault(); document.getElementById('user-force-form-{{$user->id}}').submit(); }">delete</a>
                    <form id="user-force-form-{{$user->id}}" class="d-none hidden" action="{{ route('users.force_delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
    @if($companies_number > 0)
    <h2 class="sub-header"><i class="fa fa-building mr-3"></i>Companies <span class="pull-right pr-5 rounded-circle">{{ $companies_number }}</span></h2>
    <div class="table-responsive table-sm">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->user == null ? 'Deleted' : $company->user->name }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-success">edit</a>
                    @if($company->deleted_at == null)
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('company-delete-form-{{$company->id}}').submit(); }">trash</a>
                    <form id="company-delete-form-{{$company->id}}" class="d-none hidden" action="{{ route('companies.delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" valuu="DELETE" />
                        <input type="hidden" name="company_id" value="{{ $company->id }}" />
                    </form>
                    @else
                    <a class="btn btn-sm btn-primary" href="#" onclick=" var result = confirm('Are you sure you want to restore?'); if (result) { event.preventDefault(); document.getElementById('company-restore-form-{{$company->id}}').submit(); }">restore</a>
                    <form id="company-restore-form-{{$company->id}}" class="d-none hidden" action="{{ route('companies.restore') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" valuu="DELETE" />
                        <input type="hidden" name="company_id" value="{{ $company->id }}" />
                    </form>
                    @endif
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete permenantaly?'); if (result) { event.preventDefault(); document.getElementById('company-force-form-{{$company->id}}').submit(); }">delete</a>
                    <form id="company-force-form-{{$company->id}}" class="d-none hidden" action="{{ route('companies.force_delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" valuu="DELETE" />
                        <input type="hidden" name="company_id" value="{{ $company->id }}" />
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
    @if($projects_number > 0)
    <h2 class="sub-header"><i class="fa fa-briefcase mr-3"></i>Projects<span class="pull-right pr-5 rounded-circle">{{ $projects_number }}</span></h2>
    <div class="table-responsive table-sm">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company name</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->company == null ? 'Deleted' : $project->company->name }}</td>
                <td>{{ $project->user == null ? 'Deleted' : $project->user->name }}</td>
                <td>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-success">edit</a>
                    @if($project->deleted_at == null)
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('project-delete-form-{{$project->id}}').submit(); }">trash</a>
                    <form id="project-delete-form-{{$project->id}}" class="d-none hidden" action="{{ route('projects.delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                    </form>
                    @else
                    <a class="btn btn-sm btn-primary" href="#" onclick=" var result = confirm('Are you sure you want to restore?'); if (result) { event.preventDefault(); document.getElementById('project-restore-form-{{$project->id}}').submit(); }">restore</a>
                    <form id="project-restore-form-{{$project->id}}" class="d-none hidden" action="{{ route('projects.restore') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                    </form>
                    @endif
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete permenantaly?'); if (result) { event.preventDefault(); document.getElementById('project-force-form-{{$project->id}}').submit(); }">delete</a>
                    <form id="project-force-form-{{$project->id}}" class="d-none hidden" action="{{ route('projects.force_delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
    @if($tasks_number > 0)
    <h2 class="sub-header"><i class="fa fa-tasks mr-3"></i>Tasks<span class="pull-right pr-5 rounded-circle">{{ $tasks_number }}</span></h2>
    <div class="table-responsive table-sm">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Project name</th>
                <th>Company name</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->project == null ? 'Deleted' : $task->project->name }}</td>
                <td>{{ $task->company == null ? 'Deleted' : $task->company->name }}</td>
                <td>{{ $task->user == null ? 'Deleted' : $task->user->name }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-success">edit</a>
                    @if($task->deleted_at == null)
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete?'); if (result) { event.preventDefault(); document.getElementById('task-delete-form-{{$task->id}}').submit(); }">trash</a>
                    <form id="task-delete-form-{{$task->id}}" class="d-none hidden" action="{{ route('tasks.delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    </form>
                    @else
                    <a class="btn btn-sm btn-primary" href="#" onclick=" var result = confirm('Are you sure you want to restore?'); if (result) { event.preventDefault(); document.getElementById('task-restore-form-{{$task->id}}').submit(); }">restore</a>
                    <form id="task-restore-form-{{$task->id}}" class="d-none hidden" action="{{ route('tasks.restore') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    </form>
                    @endif
                    <a class="btn btn-sm btn-danger" href="#" onclick=" var result = confirm('Are you sure you want to delete permenantaly?'); if (result) { event.preventDefault(); document.getElementById('task-force-form-{{$task->id}}').submit(); }">delete</a>
                    <form id="task-force-form-{{$task->id}}" class="d-none hidden" action="{{ route('tasks.force_delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
