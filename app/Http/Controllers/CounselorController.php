<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\counselor;
use App\Models\location;

class CounselorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('counselors.index')->with([
        'counselors'=>counselor::where('id',">",0)->orderBy('school')->orderBy('assignment')->get(),'locations'=>location::where('id','>',0)->orderBy('location')->get(),
      ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $counselor = new counselor;

        $counselor->name = $request->name;
        $counselor->email = $request->email;
        $counselor->school = $request->school;
        $counselor->location_id = location::where('location',$request->school)->get()[0]->id;
        $counselor->assignment = $request->assignment;
        $counselor->save();
        return redirect('/counselors');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

      $counselor = counselor::find($request->id);

      $counselor->name = $request->name;
      $counselor->email = $request->email;
      $counselor->school = $request->school;
      $counselor->location_id = location::where('location',$request->school)->get()[0]->id;
      $counselor->assignment = $request->assignment;
      $counselor->save();
      // $counselor->school_year = $request->school_year;
      return redirect('/counselors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      counselor::destroy($id);
      return redirect('/counselors');
    }
}
