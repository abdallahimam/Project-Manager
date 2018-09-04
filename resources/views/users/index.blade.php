
@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card bg-light">
                <div class="card-header text-secondary">
                    <span class="mb-0 h4">Users</span>
                </div>
                <div class="card-body text-secondary">
                @if(count($users))
                <form action="{{ url('users/deleteSelected') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" valuu="DELETE" />
                    <table class="table-borderless table-responsive text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>First name</th>
                                <th>Middle name</th>
                                <th>Last name</th>
                                <th>E-mail</th>
                                <th>Role ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkUsers" name="id[]" value="{{ $user->id }}" />
                                    </td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->middle_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role_id}}</td>
                                    <!--
                                    <td>
                                        <form id="deleteOne" action="{{ route('users.destroy', [$user->id]) }}" method="post">
                                            <input form="deleteOne" type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input form="deleteOne" type="hidden" name="_method" valuu="DELETE" />
                                            <input form="deleteOne" type="submit" value="Delete" class="btn btn-danger btn-sm" />
                                        </form>
                                    </td>
                                    -->
                                </tr>
                            @endforeach
                            {{ $users->appends(['trashesPage' => $trashed->currentPage()])->links() }}
                        </tbody>
                    </table>
                    <br />
                    <input type="checkbox" id="checkAllLeft" name="selectAll" value="selectAllUsers" />
                    <label for="checkAllLeft">select all</label>
                    <input type="submit" name="trash" value="Delete Selected" class="btn btn-danger btn-sm" />
                    <input type="submit" name="force" value="Force Delete" class="btn btn-danger btn-sm" />
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card bg-light">
                <div class="card-header text-secondary">
                    <span class="mb-0 h4">Trashed Users</span>
                </div>
                <div class="card-body text-secondary">
                @if(count($trashed))
                    <form action="{{ url('users/deleteSelected') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" valuu="DELETE" />
                        <table class="table-borderless table-responsive text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>First name</th>
                                    <th>Middle name</th>
                                    <th>Last name</th>
                                    <th>E-mail</th>
                                    <th>Role ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trashed as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkTrashes" name="id[]" value="{{ $user->id }}" />
                                        </td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->middle_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role_id}}</td>
                                        <!--
                                        <td>
                                            <form id="deleteOne" action="{{ route('users.destroy', [$user->id]) }}" method="post">
                                                <input form="deleteOne" type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input form="deleteOne" type="hidden" name="_method" valuu="DELETE" />
                                                <input form="deleteOne" type="submit" value="Delete" class="btn btn-danger btn-sm" />
                                            </form>
                                        </td>
                                        -->
                                    </tr>
                                @endforeach
                                {{ $trashed->appends(['usersPage' => $users->currentPage()])->links() }}
                            </tbody>
                        </table>
                        <br />
                        <input type="checkbox" id="checkAllRight" name="selectAll" value="selectAllTrashes" />
                        <label for="checkAllRight">select all</label>
                        <input type="submit" name="restore" value="Restore" class="btn btn-danger btn-sm" />
                        <input type="submit" name="force" value="Force Delete" class="btn btn-danger btn-sm" />
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection