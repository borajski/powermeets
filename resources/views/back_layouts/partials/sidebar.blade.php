<div id="mySidebar" class="sidebar">
 <div class="sidebar_content">
 <div class="text-center">
        <a href="/profile">
        @if (auth()->user()->details)
        <img src="{{ asset(auth()->user()->details->avatar) }}" class="profile_image" alt="">
        @else
       <img src="{{ asset('images/users/default-avatar.png') }}" class="profile_image" alt="">
        @endif
        <p><small>{{auth()->user()->name}}</small></p>
      </a>
      </div>
      <a href="/home">Dashboard</a>
   <a href="/create_meet">Create meet</a>
  <a href="#">Meets list</a>

</div>
</div>