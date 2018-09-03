@if(isset($errors) && count($errors) > 0)
<div class="container">
    <div class="alert alert-dismissable alert-danger fade show">
        <button type="buttom" class="close" data-dismiss="alert" aria-lable="Close"><span aria-hidden="true">&times;</span></button>
        <ul class="list-group list-group-flush">
            @foreach($errors as $error)
            <li class="list-group-item-danger">{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif