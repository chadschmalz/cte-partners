<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\cluster;
use App\Models\pathway;
use App\Models\pathway_seat;
use App\Models\semester;
use App\Models\student;
use App\Models\student_semester;

use DB;
use Auth;

class PathwaySeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pathwayseats($activesemester = NULL)
    {
      if($activesemester == NULL)
        $activesemester = semester::where('status','active')->get()[0]->id;

      $pathwayseats =  pathway_seat::where('semester_id',$activesemester)->join('pathways','pathways.id','pathway_seats.pathway_id')->orderBy('pathway_desc')->get();
      $data = array(
                'pathwayseats'=> $pathwayseats,
                'activesemester'=> $activesemester,
                'semesters'=> semester::whereIn('id',[$activesemester-1,$activesemester,$activesemester+1])->get(),
               );
        return view('pathwayseats.index')->with($data);
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
      $pathway = new pathway;

      $pathway->pathway_desc = $request->pathdesc;
      $pathway->cluster_id = $request->cluster;

      if($request->note <> NULL)
      $pathway->note = $request->note;

      $pathway->save();


      $seat = new pathway_seat;
      $seat->seats = 0;
      $seat->allocation = 0;
      $seat->semester_id = App\semester::where('stats','active')->get()[0]->id;
      $seat->save();


      $curClusters =  cluster::all();

      $data = array(
                 'pathwayCreatedmessage'=> "Pathway Created",
                 'clusters'=> $curClusters,
               );

     return view('utils')->with($data);
    }
    public function sampleuploadfile()
    {
      $file="samplePathways.csv";
      return Storage::download($file);
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
    public function update(Request $request)
    {

      foreach ($request->ids as $key => $value) {
        $seat = pathway_seat::where('pathway_id',$value)->where('semester_id',$request->activesemester)->get()[0];
        if($seat->seats <> $request->seats[$key]){ //$seat->seats <> $request->seats[$key]
          $seat->seats = $request->seats[$key];
          $seat->save();
        }

      }

      return redirect('/pathwayseats/'.$request->activesemester);

    }
    public function copy(Request $request)
    {

      if(count(pathway_seat::where('semester_id',$request->tosemester)->get()) == 0){
        $seats = pathway_seat::where('semester_id',$request->fromsemester)->get();

        foreach ($seats as $key => $seat) {
            $newseat = new pathway_seat;
            $newseat->pathway_id = $seat->pathway_id;
            $newseat->seats = $seat->seats;
            $newseat->semester_id = $request->tosemester;
            $newseat->save();

          }
      }

      return redirect('/pathwayseats/'.$request->tosemester);

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

    public function seatallocation($activesemester)
    {
      if($activesemester == NULL)
        $activesemester = semester::where('status','active')->get()[0]->id;

        $pathwayseats =  pathway_seat::where('semester_id',$activesemester)->join('pathways','pathways.id','pathway_seats.pathway_id')->select('pathway_seats.*','pathways.pathway_desc')->orderBy('pathways.pathway_desc')->get();

        //Add any pathways that are missing
        if($pathwayseats->count() > 0 ){
          $curPathways =  pathway_seat::where('semester_id',$activesemester)->join('pathways','pathways.id','pathway_seats.pathway_id')->select('pathways.id')->orderBy('pathways.pathway_desc')->pluck('id');
          $missingPathways =  pathway::whereNotIn('id',$curPathways)->get();

          foreach ($missingPathways as $key => $pathway) {
            $newseat = new pathway_seat;
            $newseat->pathway_id = $pathway->id;
            $newseat->seats = 0;
            $newseat->semester_id = $activesemester;
            $newseat->save();
          }

          $pathwayseats =  pathway_seat::where('semester_id',$activesemester)->join('pathways','pathways.id','pathway_seats.pathway_id')->select('pathway_seats.*','pathways.pathway_desc')->orderBy('pathways.pathway_desc')->get();

        }

        foreach ($pathwayseats as $key => $pathwayseat) {
          $pathwayseat->allocation = 0;
          $newCount = 0 ;
          $newCount = DB::table('student_semesters')
              ->join('students','student_semesters.student_id','=','students.id')->where('students.pathway_id',$pathwayseat->pathway_id)->whereNULL('student_semesters.deleted_at')
                          ->where('student_semesters.semester_id', '=', $activesemester)->sum('student_semesters.seats');


          if($newCount != $pathwayseat->allocation){
             $pathwayseat->allocation = $newCount;
             $pathwayseat->save();
          }

        }


      $data = array(
                'pathwayseats'=> $pathwayseats,
                'activesemester'=> $activesemester,
                'semesters'=> semester::whereIn('id',[$activesemester-1,$activesemester,$activesemester+1])->get(),
               );
        return view('pathwayseats.allocation')->with($data);
    }
}
