<x-admin-master>


    @section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    @if(session('delete-message') )
    <div class="alert alert-danger"> {{Session::get('delete-message')}}    </div>
@endif

    <!-- Page Heading -->
    

    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>view</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>view</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            
                        <tr>
                            <td>
                                {{-- {{$user->id}} --}}
                                <img height='30px' class="img-profile rounded-circle avatar" src="{{$user->avatar ?? 'https://cdn-icons-png.flaticon.com/512/3237/3237472.png'}}">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('users.posts.display',$user->id)}}">Click</a>
                            </td>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'route'=>['users.destroy', $user->id]]) !!}

                                @csrf
                                {!! Form::submit( 'DELETE' , ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>


                        @endforeach

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{$users->links('pagination::bootstrap-4')}}
</div>
<!-- /.container-fluid -->


    @endsection


    @section('scripts')
         <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('js/custom_jquery.js')}}"></script>
        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('vendor/js/demo/datatables-demo.js')}}"></script> --}}
    @endsection




 


</x-admin-master>