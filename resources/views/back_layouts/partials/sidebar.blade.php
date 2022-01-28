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
   <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>
</div>