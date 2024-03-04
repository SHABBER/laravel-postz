<x-admin-master>

    @section('content')
    <div class="container">

        <div class="col-sm-6">
            <h4>Edit Role: {{$role->name}}</h4>
        <form method="POST" action="{{route('roles.update',$role)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="rolename">Name</label>
            <input type="text" class="form-control" id="rolename" name="name" value="{{$role->name}}">
            @error('name')
                {{$message}}
            @enderror
            </div>
            <div class="form-group">
            <label for="roleslug">Slug</label>
            <input type="text" class="form-control" id="roleslug" name="slug" value="{{$role->slug}}">
            @error('slug')
                {{$message}}
            @enderror
            </div>
           


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Permissions</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Permissions</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($permissions as $permission)
                            
                        <tr>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" id="{{$permission->id}}"  @if($role->permissions()->pluck('slug')->contains($permission->slug)) {{"checked"}} @endif >
                                  </div>    
                                {{-- {{$permission->id}} --}}
                            </td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->slug}}</td>
                            <td>   
                                Actions
                                {{-- {!! Form::open(['method'=>'DELETE', 'route'=>['roles.destroy', $role->id] , 'style'=>'display:inline;']) !!}

                                @csrf
                                {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger' , 'style'=>'display:inline']) !!}
                                {!! Form::close() !!}


                                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info">Edit</a> --}}


                            </td>
                        </tr>
                        @endforeach

                        
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>



    </div>
    @endsection

</x-admin-master>