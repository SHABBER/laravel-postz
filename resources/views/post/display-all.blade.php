<x-admin-master>
    @section('content')
        
    

<!-- Begin Page Content -->
<div class="container-fluid">

    @if(Session::has('message'))
        @if(session('action') == 'delete')
            <div class="alert alert-danger"> {{Session::get('message')}}    </div>
        @endif

        @if(session('action') == 'create')
            <div class="alert alert-success"> {{Session::get('message')}}    </div>
        @endif

        @if(session('action') == 'update')
            <div class="alert alert-success"> {{Session::get('message')}}    </div>
        @endif
    @endif

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Posts</h1> --}}
    

    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h3 class=" h3 m-0 font-weight-bold text-primary">Posts</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:20%">Title</th>
                            <th>UserId</th>
                            <th>Created at</th>
                            <th>View</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Created by</th>
                            <th>Created at</th>
                            <th>action</th>
                            <th>action</th>
                            <th>action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($posts as $post)
                            
                        <tr >
                            <td  onclick="showHideRow('rowbody{{$post->id}}');">{{$post->title}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->created_at}}</td>
                            <td><a class='btn btn-secondary' href="{{route('posts.show',['post'=>$post->id])}}">View</a></td>
                            <td>
                                @can('delete',$post)
                                {!! Form::open(['method'=>'DELETE', 'route'=>['posts.destroy', $post->id]]) !!}

                                @csrf
                                {!! Form::submit( 'DELETE' , ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                            <td>
                                @can('update',$post)
                                <a class='btn btn-secondary' href="{{route('posts.edit',['post'=>$post->id])}}">Edit</a></td>
                                @endcan  
                            <tr id="rowbody{{$post->id}}" style="display: none;" >
                                <td colspan=1>
                                    <img height="80px" src="{{$post->post_image}}" class="{{$post->post_image}} ?? d.none">
                                </td>
                                <td colspan=5>
                                    {!! substr(strip_tags($post->body),0,300) . "..." !!}
                                </td>
                            </tr>

                        </tr>


                        @endforeach

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center"> 
    {{$posts->links('pagination::bootstrap-4')}}
</div>
</div>
<!-- /.container-fluid -->


    @endsection


    @section('scripts')
         <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('vendor/js/demo/datatables-demo.js')}}"></script> --}}
        <script src="{{asset('js/custom_jquery.js')}}"></script>
    @endsection


</x-admin-master>