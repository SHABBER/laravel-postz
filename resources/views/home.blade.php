<x-home-master>
@section('content')

<h1 class="my-4">Latest Posts
          {{-- <small>Secondary Text</small> --}}
        </h1>
       
        <!-- Blog Post -->
        @foreach ($posts as $post)
        <div class="card mb-4">
          <img class="card-img-top {{$post->post_image ?? 'd-none'}}" src="{{$post->post_image}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <p class="card-text">{!! substr(strip_tags($post->body), 0, 200) !!} ...</p>
           


            <div class="my-3">
              @foreach($post->categories as $category)
              <div class="form-check form-check-inline">
                <span class="badge badge-primary">{{$category->name}}</span>
              </div>
              @endforeach
            </div>

            <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on {{$post->created_at}} by
            {{$post->user->name}};
          </div>
        </div>
        @endforeach

        <!-- Pagination -->
       

        {{$posts->links('pagination::bootstrap-4')}}

@endsection

</x-home-master>