@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><a href="{{ route('users.show', [$user->id]) }}"><i class="fa fa-user mr-3"></i>{{ $user->name }}</a></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" name="fname" class="form-control" placeholder="First name" value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Middle name</label>
                                    <input type="text" name="mname" class="form-control" placeholder="Middle name" value="{{ $user->middle_name }}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last name" value="{{ $user->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone number" value="{{ $user->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Update Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Conform password</label>
                                    <input type="tel" name="phopassword_confirmationne" class="form-control" placeholder="Confirm password" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City" value="{{ $user->city }}">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" placeholder="Country" value="{{ $user->country }}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="number" name="postal-code" class="form-control" placeholder="ZIP Code" value="{{ $user->postal_code }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <textarea name="about-me" class="form-control" placeholder="Here can be your description" value="{{ $user->about_me }}">{{ $user->about_me }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
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
                        <p class="description">{{ $user->username == null ? 'No username' : $user->username }}</p>
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