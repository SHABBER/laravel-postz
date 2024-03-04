<x-admin-master>
  @section('content')
  

<div class="container">
    @if(session('permissionadd'))
        <div class="alert alert-success"> {{Session::get('permissionadd')}}    </div>
    @endif
    @if(session('permissiondelete'))
        <div class="alert alert-danger"> {{Session::get('permissiondelete')}}    </div>
    @endif
  <div class="card shadow">
      <div class="card-header py-3">
          
          <h6 class="m-0 font-weight-bold text-primary">Manage Permissions</h6>
          <div class="py-3">
              Create Permission: 
              <form class="form-inline  " action="{{route("permissions.store")}}" method="POST">
                @csrf
                  <div class="form-group mx-sm-3 mb-2">
                      <label for="role-name" class="mx-3">Name:  </label>
                      <input type="text" class="form-control" id="role-name" name="name" value="{{old('name')}}" placeholder="@error('name'){{$message}} @else {{"Enter name"}} @enderror ">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="role-slug" class="mx-3">Slug:  </label>
                    <input type="text" class="form-control" id="role-slug" name="slug" value="{{old('slug')}}" placeholder="@error('slug'){{$message}} @else {{"Enter name"}} @enderror ">
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
                      @foreach ($permissions as $permission)
                          
                      <tr>
                          <td>{{$permission->id}}</td>
                          <td>{{$permission->name}}</td>
                          <td>{{$permission->slug}}</td>
                          <td>   
                              {!! Form::open(['method'=>'DELETE', 'route'=>['permissions.destroy', $permission->id] , 'style'=>'display:inline;']) !!}

                              @csrf
                              {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger' , 'style'=>'display:inline']) !!}
                              {!! Form::close() !!}

                              <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-info">Edit</a>

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