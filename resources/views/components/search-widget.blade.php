<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <div class="input-group">
        <input type="text" class="form-control" id="live-post-search" placeholder="Search for...">
        {{-- <span class="input-group-btn">
          <button class="btn btn-secondary" type="button">Go!</button>
        </span> --}}
       
      </div>
      <div>
        
        <div id="search-result"></div>
      </div>
    </div>
</div>

@section('scripts')
<script src="{{asset('js/custom_jquery.js')}}"></script>
@endsection