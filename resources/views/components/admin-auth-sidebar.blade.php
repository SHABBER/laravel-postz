<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuth" aria-expanded="true" aria-controls="collapseUser">
      <i class="fas fa-fw fa-cog"></i>
      <span>Authorization</span>
    </a>
    <div id="collapseAuth" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">User Components:</h6>
        <a class="collapse-item" href="{{route('roles')}}">Manage Roles</a>
        <a class="collapse-item" href="{{route('permissions')}}">Manage Permissions</a>
      </div>
    </div>
</li>