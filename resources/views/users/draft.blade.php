<!--
    @if($users_number > 0)
    <h2 class="sub-header">Users <span class="pull-right pr-5 rounded-circle">{{ $users_number }}</span></h2>
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
    -->


@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><a href="{{ route('users.show', $user->id) }}"><i class="fa fa-user mr-3"></i>{{ $user->name }}</a></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>Name</label>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->name == null ? 'No Name' : $user->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>E-mail</label>
                                <span></span>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Phone number</label>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->phone == null ? 'No phone' : $user->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->address == null ? 'No address' : $user->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>City</label>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->city == null ? 'No city' : $user->city }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Country</label>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->country == null ? 'No country' : $user->country }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <p class="border-secondary border rounded p-2 pl-3">{{ $user->postal_code == null ? 'No ZIP Code' : $user->postal_code }}</p>                                    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>About</label>
                                <div class="border-secondary border rounded p-2 pl-3 about">{{ $user->about_me }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-info btn-fill pull-right">Edit Profile</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-image">
                    <img src="{{ asset('img/IMG_20180710_022015_1.png') }}" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            <img class="avatar border-gray" src="{{ asset('img/private-image-icon.jpg') }}" alt="...">
                            <h5 class="title">Mike Andrew</h5>
                        </a>
                        <p class="description">
                            michael24
                        </p>
                    </div>
                    <p class="description text-center">
                        "Lamborghini Mercy
                        <br> Your chick she so thirsty
                        <br> I'm in that two seat Lambo"
                    </p>
                </div>
                <hr>
                <div class="button-container mr-auto ml-auto">
                    <button href="#" class="btn btn-simple btn-link btn-icon">
                        <i class="fa fa-facebook-square"></i>
                    </button>
                    <button href="#" class="btn btn-simple btn-link btn-icon">
                        <i class="fa fa-twitter"></i>
                    </button>
                    <button href="#" class="btn btn-simple btn-link btn-icon">
                        <i class="fa fa-google-plus-square"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



