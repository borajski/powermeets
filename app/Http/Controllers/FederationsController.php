<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Federation;
use App\Models\Photo;

class FederationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $query = (new Federation())->newQuery();
        $federacije = $query->orderBy('name')->get();
        return view('back_layouts.federations.index')->with('federacije',$federacije);;
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
        $federation = new Federation();
      $stored = $federation->validateRequest($request)->storeData($request); // gives federation id
      if ($stored)
      {
        if ($request->hasFile('logo')) {
          $path = Photo::imageUpload($request->file('logo'), Federation::find($stored), 'federations', 'logo');
          $federation->updateImagePath($stored, $path);
      }
      return redirect('/federations')->with(['success' => 'Federation created successfully!']);
      }
      else {
         return redirect()->back()->with(['error' => 'Oops! Some errors occured!']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $federation = Federation::find($id);
        if ($federation->logo != NULL)
        {
          Photo::imageDelete($federation, 'federations', 'logo');
        }
        $federation->delete();
        return redirect('/federations')->with(['success' => 'Federacija je uspješno obrisana!']);
    }
}
