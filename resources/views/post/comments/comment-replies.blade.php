<x-admin-master>
    
    @section('content')

    <div class="card-body">
        @if(!empty($replies))
        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Comment</th>
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
                    
                    @foreach ($replies as $reply)
                        
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
                        <td>{{$reply->id}}</td>
                        <td>
                            {{-- <a href="{{route('posts.show',$comment->post_id)}}">{{$comment->post_id}}</a> --}}
                            {{-- <a href="{{url('posts/'.$comment->post_id.'#comment'.$comment->id)}}">{{$comment->post_id}}</a> --}}
                            <a href="{{url('posts/'.$post->id.'#comment'.$reply->comment_id)}}"><button class="btn btn-info">Open Comment</button></a>
                            </td>
                        <td>{{$reply->author}}</td>
                        <td>{{$reply->email}}</td>
                        <td>{{$reply->body}}</td>
                        <td>{{$reply->created_at}}</td>
                        <td>
                                {{-- actions --}}
                              {!! Form::open(['method'=>'DELETE', 'route'=>['commentReplies.destroy', $reply->id] , 'style'=>'display:inline;']) !!}
                              @csrf
                              {!! Form::submit( 'Delete' , ['class' => 'btn btn-danger mb-1' , 'style'=>'display:inline']) !!}
                              {!! Form::close() !!}
                            
                            
                              {{-- {!! Form::open(['method'=>'PATCH', 'route'=>['commentReplies.update', $reply->id] , 'style'=>'display:inline;']) !!}
                              @csrf
                              {!! Form::submit( ($reply->is_active == 0) ? 'Approve' : 'Disapprove' , ['class' => 'btn btn-primary mb-1' , 'style'=>'display:inline']) !!}
                              {!! Form::close() !!} --}}

                              <button class="btn btn-primary mb-1" onclick="approvecommentreply(event, '{{$reply->id}}')">{{($reply->is_active == 0) ? 'Approve' : 'Disapprove'}}</button>
                           

                            {{-- <a href="{{route('comments.update')}}" class="btn btn-primary">Approve</a> --}}


                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        @else   
            <h3>No replies</h3>
        @endif

    @endsection

    @section('scripts')
    <!-- Page level plugins -->
   <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

   <!-- Page level custom scripts -->
   <script src="{{asset('vendor/js/demo/datatables-demo.js')}}"></script>
   <script src="{{asset('js/custom_jquery.js')}}"></script>
@endsection



</x-admin-master>