<x-admin-master>
    
    @section('content')

    <div class="container">
    @if(session('update-message') )
        <div class="alert alert-success"> {{Session::get('update-message')}}    </div>
    @endif

    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3">
                    <img class="rounded-circle mt-5 avatar-img" width="150px" src='{{ $user->avatar ?? "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"}}'>
                    <span class="font-weight-bold">{{$user->username}}</span><span class="text-black-50">{{$user->email}}</span>
                </div>

            </div>

            <div class="col-md-8">
                <div class="p-5 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">User Profile</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                        
                        <h1 class="h1 border-bottom">{{$user->name}}</h1>
                        </div>   
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <h4 class="h4"> {{$user->email}}</h4>
                        </div>

                        <div class="col-md-12">
                            <h6 class="h6">joined  {{$user->created_at->diffForHumans()}}</h6>
                        </div>
                    </div>

                    <div class="row mt-10">

                        
                        {{-- <div>
                            <button class="btn">
                                    DELETE
                            </button>
                        </div> --}}

                        @can('update_role')
                        <div>
                            <form action="{{route('users.roles.update',$user->id)}}">
                                @method('PUT')
                                Roles:  
                                @foreach($roles as $role)
                                <div class="form-check form-check-inline">
                                    <input name="roles[]" class="form-check-input" type="checkbox" id="{{$role->slug}}" value="{{$role->id}}" @if($user->roles()->pluck('slug')->contains($role->slug)) {{"checked"}} @endif>
                                    <label class="form-check-label" for="{{$role->slug}}">{{$role->name}}</label>
                                </div>
                                @endforeach
                                <button class="btn btn-primary btn-sm" type="submit">Update roles</button>
                            </form>
                        </div>
                        @else
                            <div class="row mx-3">Roles: </div>
                            @foreach($user->roles as $role)
                            <div class="form-check form-check-inline">
                                {{-- <input name="roles[]" class="form-check-input" type="checkbox" id="{{$role->slug}}" value="{{$role->id}}" @if($user->roles()->pluck('slug')->contains($role->slug)) {{"checked"}} @endif>
                                <label class="form-check-label" for="{{$role->slug}}">{{$role->name}}</label> --}}
                                {{-- <label class="form-check-label" for="{{$role->slug}}">{{$role->name}}</label> --}}
                                <span class="badge badge-primary">  {{$role->name}}  </span>
                            </div>
                            @endforeach
                        @endcan


                    </div>
                    
                    
                </div>
            </div>
            
        </div>
    {{-- </div>
    </div>
    </div> --}}





    <div class="col-md-12">
        <br>
        <h3 class="border-bottom">Posts by {{$user->name}}</h3>
        {{-- {{dd($posts)}} --}}
        @if($posts->count() != 0)
        @foreach ($posts as $post)
        <div class="card mb-4">
          <img class="card-img-top {{$post->post_image ?? 'd-none'}}" src="{{$post->post_image}}" alt="Card image cap" 
            style="object-fit:cover;
                    object-position: right;
                    width:100%;
                    height:200px;
                    border: solid 1px #CCC">
          <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <p class="card-text">{{substr($post->body, 0, 200)}} ...</p>
            <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on {{$post->created_at}} by
            {{$post->user->name}};
          </div>
        </div>
        
        @endforeach

        @else
        <h6>No posts</h6>
        @endif

    </div>
    </div>




    @endsection

</x-admin-master>