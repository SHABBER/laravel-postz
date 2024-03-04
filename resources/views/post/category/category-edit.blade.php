<x-admin-master>
    @section('content')
        
    <div class="container">

        <div class="col-sm-6">
            <h4>Edit Category: {{$category->name}}</h4>
        <form method="POST" action="{{route('categories.update',$category)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
                @error('name')
                 {{$message}}
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>