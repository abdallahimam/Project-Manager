<div class="comments">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-8"><span class="text-lg-right"><i class="fa fa-comments"></i> Recent Comments.</span></div>
                <div class="col-sm-4 text-right"><span class="text-sm-right text-info text-right pr-5">{{ @count($comments )}}</span></div>
            </div>  
        </div>
        <div class="card-body">
            <div class="row">   
                <div class="col-md-12">
                @foreach($comments as $comment)
                    <div class="media mb-3">
                        <a href="#"><img class="d-inline mr-2 rounded-circle" width="30" height="30" src="{{ asset('img/private-image-icon.jpg') }}" alt="Generic placeholder image"></a>
                        <div class="media-body">
                            <a href="#"><h5 class="mt-0">{{ $comment->user->name }}</h5></a>
                            <p class="lead">{{ $comment->body }}</p>
                            <a href="#">{{ $comment->url }}</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>