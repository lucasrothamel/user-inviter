<li class="nav-item">
    <a class="nav-link" href="{{url("/home")}}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{url("/users")}}">Find a user</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{url("/users/" . Auth::user()->id)}}">My Profile</a>
</li>

@if(Gate::allows('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{url("/admin/invitations/list")}}">All Invitations</a>
    </li>
@endif

@include('partials.nav.dropdown')