<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\student;
use App\Models\business;
use App\Models\cluster;
use App\Models\pathway;
use App\Models\activity;
use App\Models\poc;
use App\Models\location;
use App\Models\business_activity;
use App\Models\business_pathway;
use App\Models\business_internship;
use App\Models\student_internship;
use App\Models\semester;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedSemester = NULL,$selectedLocation = null, $selectedPathway= NULL )
    {
        $students = [];
        if($selectedSemester== NULL){

          $selectedSemester = semester::where('status','active')->get()[0]->id;
        }
        // $user->posts()
        // ->where(function (Builder $query) {
        //     return $query->where('active', 1)
        //                  ->orWhere('votes', '>=', 100);
        // })
        // ->get();
            if($selectedSemester == 'all' && ($selectedPathway == 'all' || $selectedPathway == NULL) && ($selectedLocation == 'all' || $selectedLocation == NULL)){
              $students =  student::all();
            }
            else if( ($selectedPathway == 'all' || $selectedPathway == NULL) && ($selectedLocation == 'all' || $selectedLocation == NULL)){
              $students =  student::where('students.id','like','%')->join('student_internships','student_internships.student_id','students.id')->where('semester_id',$selectedSemester)->select('students.*')->orderBy('students.name','asc')->get();
            }else if($selectedPathway!= NULL && $selectedLocation == 'all'){
              $students =  student::where('pathway_id',$selectedPathway)
                    ->orderBy('pathway_id', 'asc')
                    ->get();
            }else if($selectedPathway== NULL && $selectedLocation != NULL && $selectedLocation != 'all'){
              $students =  student::where('location_id',$selectedLocation)
                    ->orderBy('name', 'asc')
                    ->get();
            }
            else{
            $students = student::all();
                }

              $pathways = pathway::all();



            $data = array(
                        'selectedSemester'=> $selectedSemester,
                        'selectedPathway'=> $selectedPathway,
                        'selectedLocation'=> $selectedLocation,
                        'clusters'=> cluster::all(),
                        'pathways'=> $pathways,
                        'locations'=> location::all(),
                        'semesters'=> semester::where('id','like','%')->orderBy('semester_enddt')->get(),
                       'students'=> $students,
                     );
              return view('student.studentlist')->with($data);
    }

    public function studentdetail($id)
    {

      $student =  student::find($id);

      $pathways = pathway::where('pathway_desc','like','%' )->orderBy('pathway_desc')->get();
      // return $pathways;
      $activitys = activity::all();

      $data = array(
        'pathways'=> $pathways,
        'activitys'=> $activitys,
        'locations'=> location::all(),
         'student'=> $student,
         'semesters'=> semester::where('semester_enddt','>=',date("Y-m-d H:i:s"))->orderBy('semester_enddt')->get(),
               );
        return view('student.studentdetail')->with($data);
    }
    public function addinternship(Request $request)
  {

    if($request->stemployer != "")
    {
      $business =  business::find($request->stemployer);

          $internship = new student_internship;
          $internship->business_id = $request->stemployer;
          $internship->semester_id = $request->stsemester;
          $internship->student_id = $request->studentid;

          $internship->save();

    }

      return redirect('studentdetail/' . $request->studentid);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      // return $request;
      $student = new student;
      $student->name = $request->stname;
      $student->phone = $request->stphone;
      $student->email = $request->stemail;
      $student->location_id = $request->stlocation_id;
      $student->pathway_id = $request->stpathway;
      $student->emerg_phone = $request->stemgphone;
      $student->emerg_contact = $request->stemgname;
      $student->notes = $request->stnotes;

      $student->save();

      if($request->employer != "")
      {
            $internship = new student_internship;
            $internship->business_id = $request->stemployer;
            $internship->semester_id = $request->stsemester;
            $internship->student_id = $student->id;

            $internship->save();

      }

      return redirect('/students');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
      $student = student::find($request->studentid);
      $student->name = $request->stname;
      $student->phone = $request->stphone;
      $student->email = $request->stemail;
      $student->location_id = $request->stlocation_id;
      $student->pathway_id = $request->stemgname;
      $student->emerg_phone = $request->stemgphone;
      $student->pathway_id = $request->stpathway;
      $student->notes = $request->stnotes;
      $student->save();

      return redirect('studentdetail/' . $student->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        student::destroy($id);
        return redirect('/students');
    }
    public function removeinternship(Request $request,$id)
    {
        student_internship::destroy($id);
        return redirect('/studentdetail/' . $request->studentid);
    }
}
