@if(session()->has('success'))
    <div class="container">
        <div class="alert alert-dismissable alert-success fade show">
            <button type="buttom" class="close" data-dismiss="alert" aria-lable="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{!! session()->get('success') !!}</strong>
        </div>
    </div>
@endif