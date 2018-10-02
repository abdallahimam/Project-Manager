
@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="card bg-light">
                <div class="card-header text-secondary">
                    <span class="mb-0 h4">Manage the users</span>
                </div>
                <div class="card-body text-secondary">
                    @if(count($users))
                    <form action="{{ url('users/deleteSelected') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" valuu="DELETE" />
                        <table class="table table-borderless table-responsive text-center table-sm table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>First name</th>
                                    <th>Middle name</th>
                                    <th>Last name</th>
                                    <th>E-mail</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input checkUsers" id='checkAllusers{{ $user->id }}' name="id[]" value="{{ $user->id }}" />
                                                <label class="custom-control-label" for="checkAllusers{{ $user->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->middle_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role->name}}</td>
                                        <td>
                                            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ route('users.force_delete', [$user->id]) }}" class="btn btn-danger btn-sm">Remove</a>
                                            @if($user->deleted_at != null)
                                            <a href="{{ route('users.restore', [$user->id]) }}" class="btn btn-primary btn-sm">Restore</a>
                                            @else
                                            <a href="{{ route('users.delete', [$user->id]) }}" class="btn btn-danger btn-sm">Trash</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $users->links() }}
                            </tbody>
                        </table>
                        <br />
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="checkAllLeft" name="selectAll" value="selectAllUsers" />
                            <label class="custom-control-label" for="checkAllLeft">Select all</label>
                        </div>
                        <input type="submit" name="trash" value="Trash" class="btn btn-danger btn-sm" />
                        <input type="submit" name="force" value="Remove" class="btn btn-danger btn-sm" />
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection