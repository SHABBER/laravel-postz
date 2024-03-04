<x-admin-master>
    @section('content')
    
  
  <div class="container">
    @if(session('categoryadd'))
        <div class="alert alert-success"> {{Session::get('categoryadd')}}    </div>
    @endif
    @if(session('categorydelete'))
        <div class="alert alert-danger"> {{Session::get('categorydelete')}}    </div>
    @endif
    
    <div class="card shadow">
        <div class="card-header py-3">
            
            <h6 class="m-0 font-weight-bold text-primary">Manage Categories</h6>
            <div class="py-3">
                Create Category: 
                <form class="form-inline  " action="{{route("categories.store")}}" method="GET">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="role-name" class="mx-3">Name:  </label>
                        <input type="text" class="form-control" id="role-name" name="name" value="{{old('name')}}" placeholder="@error('name'){{$message}} @else {{"Enter name"}} @enderror ">
                    </div>
                    <div class="form-group col-md-3 mb-2 ">
  
                      <button type="submit" class="btn btn-primary">Create</button>    
                  </div>
                  </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($categories as $category)
                            
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>   
                                
                                {!! Form::open(['method'=>'DELETE', 'route'=>['categories.destroy', $category] , 'style'=>'display:inline;']) !!}
  
                                @csrf
                                {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger' , 'style'=>'display:inline']) !!}
                                {!! Form::close() !!}
  
                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info">Edit</a>
  
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