<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ((auth()->user()->details->role) == 'admin')
        {
        $query = (new Meet())->newQuery();
        $natjecanja = $query->orderBy('datump')->get();
        return view('home')->with('natjecanja',$natjecanja);
      }
      else {
        $organizator = auth()->user()->id;
        $query = (new Meet())->newQuery()->where('user_id',$organizator);
        $natjecanja = $query->orderBy('datump')->get();
        return view('home')->with('natjecanja',$natjecanja);
      }
    
    }
    public function index_front()
    {
      
        $query = (new Meet())->newQuery();
        $natjecanja = $query->orderBy('datump')->get();
        return view('front_layouts.meets.index')->with('natjecanja',$natjecanja);
   
    
    }
}
