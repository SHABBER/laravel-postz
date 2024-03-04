<x-admin-master>

  @section('styles')
  
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  @endsection


    @section('content')

    
    
  
    
    <div class="container">

      @if(Session::has('message'))
      <div class="alert alert-success"> {{Session::get('message')}}    </div>
       @endif  

      <h1 >Create Post</h1>

      
    {!! Form::open( ['method'=>'POST' ,'action'=>'\App\Http\Controllers\PostController@store' , 'files'=>true] ) !!}        <!-- can also use , 'url'=>'/posts' -->

    <div class="form-group">
    {!! Form::label('title', 'Title:' , ['class'=> 'class'])  !!}
    {!! Form::text('title', Null , ['class'=> 'form-control', 'placeholder' => 'Enter title']) !!}
    @error('title')
        {{$message}}
    @enderror
    </div>
   
    <div class="form-group">
    {!! Form::label('body', 'Body:' , ['class'=> 'class'])  !!}
    {!! Form::textarea('body', Null , ['class'=> 'form-control','placeholder' =>  'Enter Body Text' ]) !!}

    @if ($errors->has('body'))
          {{ $errors->first('body') }}
    @endif
    </div> 


    <div class="form-group">
      Category:  
      @foreach($categories as $category)
      <div class="form-check form-check-inline">
          <input name="categories[]" class="form-check-input" type="checkbox" id="{{$category->id}}" value="{{$category->id}}">
          <label class="form-check-label" for="{{$category->id}}">{{$category->name}}</label>
      </div>
      @endforeach
    </div>
    


    <div class="form-group">
    {!! Form::hidden('user_id', Auth::user()->id ) !!}
    </div>
    
    {!! Form::file('file', ['class'=>' dropzone dropzone-previews', 'accept' => "image/*"]) !!}

    <br><br>
    @csrf

    {!! Form::submit( 'SUBMIT' ) !!}
    
    
    {!! Form::close() !!}
    </div>


    @endsection


    @section('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('js/tinymce.js')}}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    @endsection
</x-admin-master>