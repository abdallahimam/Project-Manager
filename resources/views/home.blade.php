@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="alert alert-info text-uppercase text-center">
        <h1>Home</h1>
    </div>

<!--
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br />
                    <hr />
                    {!! Form::open(['file' => true, 'url' => 'upload/file']) !!}
                    {!! Form::file('files[]') !!}
                    {!! Form::submit('Save (single upload)') !!}
                    {!! Form::close() !!}
                    <br />
                    <hr />
                    {!! Form::open(['files' => true, 'url' => 'upload/files']) !!}
                    {!! Form::file('files[]', ['multiple' => 'yes']) !!}
                    {!! Form::submit('Save (multiple uploads)') !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
-->
</div>
@endsection
