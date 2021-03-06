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
                        <div class="col-12 pr-1">
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
                                <div class="border-secondary border rounded p-2 pl-3 about">{!! $user->about_me == null ? 'this user is hide his bio' : $user->about_me !!}</div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->id === $user->id || auth()->user()->role_id === 1)
                    <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-info btn-fill pull-right">Edit Profile</a>
                    @endif
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
                            <h5 class="title">{{ $user->name }}</h5>
                        </a>
                        <p class="description">
                        {{ $user->username == null ? 'No username' : $user->username }}
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