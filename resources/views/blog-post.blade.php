<x-home-master>

@section('content')
 @if ($errors->has('body')) 
  <div class="alert alert-warning mt-3"> Enter message to reply    </div>
 @endif

 <!-- Title -->
 <h1 class="mt-4">{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
  by
  <a onmouseover="hoverdiv(event,'divtoshow','{{$post->user->id}}')" onmouseout="hoverdiv(event,'divtoshow','{{$post->user->id}}')" href="{{route('users.posts.display', $post->user->id)}}">{{$post->user->name}}</a>
      <div id="divtoshow" style="position: fixed;display:none;  z-index: 12;" class="card">
        <div id="profilepreview" class="row" style="width: 100%;">
          <div class="col-1 m-4">
            <img height="50px" src="" alt="" class="avatar-img">
          </div>
          <div class="col-8 card-body">
            <h5 class="card-title"></h5>
            <h6 class="card-subtitle mb-2 text-muted"></h6>
            <p class="card-text"></p>
          </div>
        </div>
      </div>
</p>

<hr>

<!-- Date/Time -->
<p>Posted on {{$post->created_at}}</p>

<!--Categories-->
<div class="my-3">
  @foreach($post->categories as $category)
  <div class="form-check form-check-inline">
    <span class="badge badge-primary">{{$category->name}}</span>
  </div>
  @endforeach
</div>

<!-- Preview Image -->
<img  class="img-fluid rounded {{$post->post_image ?? 'd-none'}}" src="{{$post->post_image}}" alt="No Image">

<hr>

<!-- Post Content -->
{{-- <p class="lead" style="white-space: pre-wrap;">{{$post->body}}</p> --}}
<p class="lead" style="white-space: pre-wrap;">{!! $post->body !!}</p>



<hr>
    {{-- commentsection --}}

            <!-- Comments Form -->
            @if(Auth::check())
            <div class="card my-4" >
              <h5 class="card-header" id='commentform'>Leave a Comment:</h5>
              <div class="card-body">
                <p class="text-success">
                  @if(session('commented') )
                     {{Session::get('commented')}}
                  @endif              
                </p>
                <form method="POST" action="{{route('comments.store', $post->id)}}" >
                  @csrf
                  <div class="form-group">
                    <textarea name="body" class="form-control" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
            @endif




    <div>
      <div class="container mt-5">
        <div class="d-flex justify-content-center row">
                @foreach ($post->comments()->where('is_active',1)->latest()->get() as $comment)
                {{-- <section id="comment{{$comment->id}}"> --}}
                <div id="comment{{$comment->id}}" class="card mt-1 px-3 bg-white comment-section w-100">
                    <div class=" d-flex flex-row user pt-3 p-2"><img height="50px" class="avatar-img" src="{{$post->user->avatar}}">
                        <div class="m-2"><span class="name font-weight-bold">{{$comment->author}}</span><br><span class="small">{{$comment->created_at}}</span></div>
                    </div>
                    <div class="p-2">
                        <p style="white-space: pre-wrap;" class="comment-content">{{$comment->body}}</p>
                    </div>
                    @if(Auth::check())
                    <form action="{{route('commentreplies.store',$comment->id)}}" method="post" >
                      @csrf
                      <input class="btn btn-outline-primary btn-sm" type="submit"  value="Reply" style="float: right" />
                      <div style="overflow: hidden; padding-right: .5em;">
                        <input type="text" name="body" class="mb-3 form-controll" style="width: 100%;" placeholder=""/>
                       
                      </div>
                    </form>
                    @endif
                    
                    
                    <div>
                      @if($comment->commentReplies->where('is_active',1)->count() > 0)
                      <div class="show-replies mb-2" id="show-replies{{$comment->id}}" onclick="showReplies('all-replies{{$comment->id}}')"><button class="btn btn-outline-primary btn-sm">Show replies ..</button></div>
                      <div class="all-replies" id="all-replies{{$comment->id}}">
                      @foreach ($comment->commentReplies()->where('is_active',1)->latest()->get()  as $reply)
                          <div class="card px-3 bg-white my-3 w-90">
                            <div class=" d-flex flex-row user pt-3 p-2 ">
                                {{-- <img height="50px" class="avatar-img" src="{{$comment->user->avatar}}"> --}}
                                      <div class="m-1"><span class="name font-weight-bold">{{$reply->author}}</span><br><span class="small">{{$reply->created_at}}</span></div>
                            </div>
                            <div class="p-1">
                              <p class="comment-content">{{$reply->body}}</p>
                            </div>
                            
                          </div>
                      @endforeach
                      </div>  
                      @endif
                    </div>
                  </div>
                {{-- </section> --}}
                @endforeach
        </div>
    </div>
    </div>

  

@endsection

@section('scripts')


    <script>
      $(document).ready(function(){

        $('.all-replies').css({  'display': 'none'});
        
      });
    </script>

    <script src="{{asset('js/custom_jquery.js')}}"></script>
@endsection

</x-home-master>