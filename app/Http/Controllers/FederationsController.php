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
        return view('back_layouts.federations.index')->with('federacije',$federacije); 
        
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
    
public function getFed($id)
{
    $federation = Federation::find($id);
    if (!$federation) {
        return response()->json(['error' => 'federation not found'], 404);
    }

    return response()->json($federation);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fedRules($fed)
    {
        $federacija = Federation::find($fed);
        $divisions = explode(",",$federacija->divisions);
        $discipline = explode(",",$federacija->disciplines);
        echo '<label class="pt-3" for="discipline"><b>DISCIPLINE</b></label>';
        foreach ($divisions as $divizija)
        {
            echo ' <div class="form-group mt-4 mb-4">
            <label for="'.$divizija.'"><b>'.$divizija.':
                </b></label>
            <br>';
            $predznak = substr($divizija,0,2).'-';
            if ($predznak == "F8-")
             {
                $disciplina = "bench press";
                echo '<div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="discipline[]" value="' . $predznak . $disciplina . '">
                <label class="form-check-label" for="' . $predznak . $disciplina . '">' . ucfirst($disciplina) . '</label>
            </div>';
             }
             else
             {
    foreach ($discipline as $disciplina) {
        echo '<div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="discipline[]" value="' . $predznak . $disciplina . '">
                <label class="form-check-label" for="' . $predznak . $disciplina . '">' . ucfirst($disciplina) . '</label>
            </div>';
    }
}
            echo '</div>';
        }    
        
    }
    public function weightCat ($id)
    {
        $upit = explode(",",$id);
        $spol = $upit[0];
        $federacija= $upit[1];
        $wcat = Federation::where('name',$federacija)->first();
        echo '<option selected></option>';
        if ($spol == "M")
            $kategorije = $wcat->wm_categories;
        else
            $kategorije = $wcat->wf_categories;

        $kategorije = explode(",",$kategorije);
                
        foreach ($kategorije as $kategorija)
        {
            echo '<option value="'.$kategorija.'">'.$kategorija.'</option>';
        }       
     
    }
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
        $federacija = Federation::find($id);
        $updated = $federacija->validateRequest($request)->updateData($request,$id);
        if ($updated)
        {
          if ($request->hasFile('logo')) {
            $path = Photo::imageUpload($request->file('logo'), $federacija, 'federations', 'logo');
            $federacija->updateImagePath($id, $path);
        }
        return redirect('/federations')->with(['success' => 'Federation updated successfully!']);
    }
    else {
       return redirect()->back()->with(['error' => 'Oops! Some errors occured!']);
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
        $federation = Federation::find($id);
        if ($federation->logo != NULL)
        {
          Photo::imageDelete($federation, 'federations', 'logo');
        }
        $federation->delete();
        return redirect('/federations')->with(['success' => 'Federacija je uspješno obrisana!']);
    }
}
