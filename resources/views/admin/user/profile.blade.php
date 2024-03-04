<x-admin-master>
    
    @section('content')

    
    @can('viewprofile',$user->id)
    @if(session('update-message') )
        <div class="alert alert-success"> {{Session::get('update-message')}}    </div>
    @endif

    {!! Form::open( ['method'=>'PATCH' ,'route'=>['user.update',$user->id] , 'files'=>true] ) !!} 
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5 avatar-img" width="150px" src='{{ $user->avatar ?? "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"}}'>
                    <span class="font-weight-bold">{{$user->username}}</span><span class="text-black-50">{{$user->email}}</span>
                </div>

                {!! Form::file('file', ['id'=>'avatar' , 'class'=>'fileclass', 'accept' => "image/*"]) !!}
                @csrf

            </div>

            <div class="col-md-5">
                <div class="p-5 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels" style="margin-top: 12px;">Name</label><input name="name" type="text" class="form-control" placeholder="name" value="{{$user->name}}">
                            @error('name')
                            {{$message}}
                            @enderror
                        </div>
                        
                        {{-- <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname"></div> --}}
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-12"><label class="labels" style="margin-top: 12px;">EMail Id</label><input name="email" type="text" class="form-control" placeholder="enter email-id" value="{{$user->email}}">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                        @error('email')
                            {{$message}}
                        @enderror
                        <div class="col-md-12"><label class="labels" style="margin-top: 12px;">Password</label><input name="password" id="password" type="password" class="form-control" placeholder="enter password" value="" >
                            @error('password')
                            {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-12"><label class="labels" style="margin-top: 12px;">Confirm Password</label><input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="enter password again" value=""></div>
                        
                    </div>
                    
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}
    @else
    <div class="container" >
    <h1>You are unauthorized</h1>
    </div>
    @endcan

    @endsection

</x-admin-master>