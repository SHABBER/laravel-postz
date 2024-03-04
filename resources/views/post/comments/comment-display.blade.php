<x-admin-master>
    
    @section('content')
    <div class="container">
    <div class="card shadow">
        <h6 class="m-0 font-weight-bold text-primary card-header py-3">Manage Comments</h6>
    <div class="card-body">
        <div class="table-responsive">
            
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Post</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th style="width:30%">body</th>
                        <th>commented on</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                {{-- <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Post</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th style="width:40%">Body</th>
                        <th>commented on</th>
                        <th>Actions</th>
                    </tr>
                </tfoot> --}}
                <tbody>
                    @foreach ($comments as $comment)
                        
                    {{-- <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>   
                            
                            {!! Form::open(['method'=>'DELETE', 'route'=>['categories.destroy', $category] , 'style'=>'display:inline;']) !!}

                            @csrf
                            {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger' , 'style'=>'display:inline']) !!}
                            {!! Form::close() !!}

                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info">Edit</a>

                        </td>
                    </tr> --}}
                   

                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>
                            {{-- <a href="{{route('posts.show',$comment->post_id)}}">{{$comment->post_id}}</a> --}}
                            <a href="{{url('posts/'.$comment->post_id.'#comment'.$comment->id)}}">{{$comment->post_id}}</a>

                            </td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{$comment->body}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>

                              {!! Form::open(['method'=>'DELETE', 'route'=>['comments.destroy', $comment->id] , 'style'=>'display:inline;']) !!}
                              @csrf
                              {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger mb-1' , 'style'=>'display:inline']) !!}
                              {!! Form::close() !!}
                            
                            
                              {{-- {!! Form::open(['method'=>'PATCH', 'route'=>['comments.update', $comment->id] , 'style'=>'display:inline;']) !!}
                              @csrf
                              {!! Form::submit( ($comment->is_active == 0) ? 'Approve' : 'Disapprove' , ['class' => 'btn btn-primary mb-1' , 'style'=>'display:inline']) !!}
                              {!! Form::close() !!} --}}

                              <button class="btn btn-primary mb-1" onclick="approvecomment(event, '{{$comment->id}}')">{{($comment->is_active == 0) ? 'Approve' : 'Disapprove'}}</button>
                           
                                <a href="{{route('commentReplies.index', $comment->id)}}" class="btn btn-secondary mb-1">Replies</a>


                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    @endsection

    @section('scripts')
    <!-- Page level plugins -->


   <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

   <!-- Page level custom scripts -->
   <script src="{{asset('vendor/js/demo/datatables-demo.js')}}"></script>
   <script src="{{asset('js/custom_jquery.js')}}"></script>

   <script>
       
   </script>


@endsection



</x-admin-master>