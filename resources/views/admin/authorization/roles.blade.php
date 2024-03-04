<x-admin-master>
    @section('content')
    

<div class="container">
    @if(session('roleadd'))
        <div class="alert alert-success"> {{Session::get('roleadd')}}    </div>
    @endif
    @if(session('roledelete'))
        <div class="alert alert-danger"> {{Session::get('roledelete')}}    </div>
    @endif
    <div class="card shadow">
        <div class="card-header py-3">
            
            <h6 class="m-0 font-weight-bold text-primary">Manage Roles</h6>
            <div class="py-3">
                Create Role: 
                <form class="form-inline" action="{{route("roles.store")}}" method="POST">
                    @csrf
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="role-name" class="mx-3">Name:  </label>
                        <input type="text" class="form-control" id="role-name" name="rolename" value="{{old('rolename')}}" placeholder="@error('name'){{$message}} @else {{"Enter name"}} @enderror ">
                         
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="role-slug" class="mx-3">Slug:  </label>
                      <input type="text" class="form-control" id="role-slug" name="roleslug" value="{{old('roleslug')}}" placeholder="@error('slug'){{$message}} @else {{"Enter slug"}} @enderror ">
                    </div>
                    <div class="form-group col-md-3 mb-2 ">

                        <button type="submit" class="btn btn-primary">Create</button>    
                    </div>
                    
                  </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roles as $role)
                            
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>   
                                {!! Form::open(['method'=>'DELETE', 'route'=>['roles.destroy', $role->id] , 'style'=>'display:inline;']) !!}

                                @csrf
                                {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger' , 'style'=>'display:inline']) !!}
                                {!! Form::close() !!}


                                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info">Edit</a>


                            </td>
                        </tr>
                        @endforeach

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{$users->links('pagination::bootstrap-4')}} --}}
</div>
    @endsection

    @section('scripts')

    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('vendor/js/demo/datatables-demo.js')}}"></script>

    @endsection

</x-admin-master>