<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gensett;

class GensettsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gensett = new Gensett();
        $stored = $gensett->validateRequest($request)->storeData($request); // gives gensett id
        if ($stored)
        {      
            return redirect()->route('meets.show', $request->meet_id)->with(['success' => 'Natjecanje je uspješno uređeno!']);
        }
        else {
           return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gensett = Gensett::find($id);
        $updated = $gensett->validateRequest($request)->updateData($request,$id);
        if ($updated)
        {
        
        return redirect()->route('meets.show', $gensett->meet_id)->with(['success' => 'Natjecanje je uspješno uređeno!']);
        }
        else {
           return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
