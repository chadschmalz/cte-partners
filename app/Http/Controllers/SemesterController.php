<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\semester;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('semesters.index')->with([
        'semesters'=>semester::where('status','!=','disabled' )->orderBy('school_year')->get(),
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

        $semester = new semester;

        $semester->school_year = $request->school_year;
        $semester->semester_desc = $request->semester_desc;
        $semester->semester_enddt = $request->semester_enddt;
        $semester->status = $request->semester_status;
        $semester->save();
        // $semester->school_year = $request->school_year;
        return redirect('/semesters');
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
      if($request->semester_status)
        {
          foreach (semester::where('status','active')->get() as $key => $value) {
            $value->status = 'inactive';
            $value->save();
          }
        }

      $semester = semester::find($request->semester_id);

      $semester->school_year = $request->school_year;
      $semester->semester_desc = $request->semester_desc;
      $semester->semester_enddt = $request->semester_enddt;
      $semester->status = $request->semester_status;
      $semester->save();
      // $semester->school_year = $request->school_year;
      return redirect('/semesters');
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
