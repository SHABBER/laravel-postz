<x-admin-master>
    @section('content')
        
    <div class="container">

        <div class="col-sm-6">
            <h4>Edit Permission: {{$permission->name}}</h4>
        <form method="POST" action="{{route('permissions.update',$permission)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$permission->name}}">
                @error('name')
                 {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{$permission->slug}}">
                @error('slug')
                 {{$message}}
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>