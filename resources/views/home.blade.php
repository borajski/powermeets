@extends('back_layouts.back-master')
@section('content')
<h2>Dashboard Text Placeholder</h2>
<p>
@if (!(auth()->user()->details))
<h4 class="text-center"><strong>Za potpuno korištenje platforme molimo vas uredite <a href="/profile" style="color:blue;">vaše korisničke podatke</a>!</strong></h4>
@endif

</p>
<h3>Full Content coming soon</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<
<div class="line"></div>

@endsection