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
use App\Models\student_semester;
use App\Models\semester;
use App\Models\counselor;

use App\Mail\ApplicationMail;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedSemester = 'unassigned',$selectedLocation = 'all', $selectedPathway= 'all' )
    {
        $students = [];
        if($selectedSemester== NULL){

          $selectedSemester = semester::where('status','active')->get()[0]->id;
        }

          if($selectedSemester == 'unassigned' && $selectedLocation == 'all' &&  $selectedPathway == 'all') {
             $students =  student::where('onboarding', 'Y')->get();
           }
           else if($selectedSemester == 'unassigned' && $selectedLocation != 'all' &&  $selectedPathway == 'all'){
             $students =  student::where('location_id',$selectedLocation)->where('onboarding', 'Y')->get();
           }
           else if( $selectedSemester == 'all' &&  $selectedLocation != 'all' &&  $selectedPathway == 'all') {
              $students =  student::where('location_id',$selectedLocation)->orderBy('name','asc')->get();
            }
            else if($selectedLocation == 'all' && $selectedSemester != 'all' && $selectedPathway == 'all'  ) {
              $students =  student::join('student_semesters','student_semesters.student_id','students.id')->whereNULL('student_semesters.deleted_at')
                          ->where('student_semesters.semester_id',$selectedSemester)
                          ->select('students.*')->orderBy('students.name','asc')->get();
            }
            else if($selectedSemester != 'all' && $selectedPathway != 'all' && $selectedLocation != 'all'){
              $students =     student::where('location_id',$selectedLocation)->where('pathway_id',$selectedPathway)
                            ->join('student_semesters','student_semesters.student_id','students.id')->whereNULL('student_semesters.deleted_at')
                            ->where('student_semesters.semester_id',$selectedSemester)
                            ->select('students.*')->orderBy('students.name','asc')->get();
            }else if($selectedSemester != 'all' && $selectedLocation != 'all' && $selectedPathway == 'all' ){
              $students =     student::where('location_id',$selectedLocation)->join('student_semesters','student_semesters.student_id','students.id')->whereNULL('student_semesters.deleted_at')
              ->where('student_semesters.semester_id',$selectedSemester)
                            ->select('students.*')->orderBy('students.name','asc')->get();

            }
            else if($selectedPathway!= 'all' && $selectedLocation == 'all' && $selectedSemester == 'all'){
              $students =   student::where('pathway_id',$selectedPathway)
                            ->select('students.*')->orderBy('students.name','asc')->get();

            }else if($selectedSemester == 'all' && $selectedLocation != 'all' && $selectedPathway!= 'all' ){
              $students =     student::where('location_id',$selectedLocation)->where('pathway_id',$selectedPathway)
                            ->select('students.*')->orderBy('students.name','asc')->get();

            }else if($selectedPathway!= 'all' && $selectedLocation != 'all' && $selectedSemester != 'all'){
              $students =     student::where('location_id',$selectedLocation)->where('pathway_id',$selectedPathway)
                            ->join('student_semesters','student_semesters.student_id','students.id')->whereNULL('student_semesters.deleted_at')
                            ->where('student_semesters.semester_id',$selectedSemester)
                            ->select('students.*')->orderBy('students.name','asc')->get();

            }else if($selectedPathway== NULL && $selectedLocation != NULL && $selectedLocation != 'all'){
              $students =  student::where('location_id',$selectedLocation)
                    ->orderBy('name', 'asc')
                    ->get();
            }
            else{
            $students = student::all();
                }

              $pathways = pathway::orderBy('pathway_desc')->get();



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
         'counselors'=> counselor::where('location_id',$student->location_id)->get(),
         'semesters'=>semester::where('semester_enddt','>=',date("Y-m-d H:i:s"))->orderBy('semester_enddt')->get(),
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
      $student->name = $request->lname.",".$request->fname;
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->phone = $request->stphone;
      $student->email = $request->stemail;
      $student->location_id = $request->stlocation_id;
      $student->pathway_id = $request->stpathway;
      $student->emerg_email = $request->stemgemail;
      $student->emerg_contact = $request->stemgname;
      $student->notes = $request->stnotes;
      $student->school_name = location::find($request->stlocation_id)->location_desc;
      $student->grad_year = $request->grad_year;
      $student->semester_apply = semester::find($request->semester_apply)->semester_desc;
      $student->onboarding = "Y";
      $student->career_interest = pathway::find($request->stpathway)->pathway_desc;

      $student->save();


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
      $student->name = $request->lname.", ".$request->fname;
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->phone = $request->stphone;
      $student->email = $request->stemail;
      $student->location_id = $request->stlocation_id;
      $student->school_name = location::find($request->stlocation_id)->location_desc;
      $student->pathway_id = $request->stemgname;
      $student->emerg_email = $request->stemgemail;
      $student->pathway_id = $request->stpathway;
      $student->notes = $request->stnotes;
      $student->save();

      return redirect('studentdetail/' . $student->id);

    }
    public function onboardingComplete($id)
    {
      $student = student::find($id);

      $student->onboarding = 'N';
      $student->save();

      return redirect('students/unassigned/'.$student->location_id );

    }
    public function addsemester(Request $request)
    {

      if($request->semester_id != "" && count(student_semester::where([['student_id',$request->student_id],['semester_id',$request->semester_id]])->get()) < 1)
      {
            $studentSem = new student_semester;
            $studentSem->semester_id =  $request->semester_id;
            $studentSem->seats =  $request->seats;
            $studentSem->student_id = $request->student_id;
            $studentSem->save();
      }

        return redirect('studentdetail/' . $request->student_id);

    }
    public function removesemester(Request $request)
    {
      if($request->semester_id != "" && count(student_semester::where([['student_id',$request->student_id],['semester_id',$request->semester_id]])->get()) > 0)
      {
            student_semester::where('student_id',$request->student_id)->where('semester_id',$request->semester_id)->delete();
      }

        return redirect('studentdetail/' . $request->student_id);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = student::find($id);

        foreach (student_semester::where('student_id',$id)->get() as $key => $sem) {
              student_semester::destroy($sem->id);
        }
        $student->delete();
        return redirect('/students');
    }
    public function removeinternship(Request $request,$id)
    {
        student_internship::destroy($id);
        return redirect('/studentdetail/' . $request->studentid);
    }
    public function applicationemail(Request $request,$id)
    {
      $student = student::find($id);
      $student->lettersent = 'Y';
      $student->lettersent_at = date('Y-m-d');
      $student->save();

      $counselor = counselor::find($request->counselor_id);

      $v = "/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/";

      if($student->emerg_email != NULL && (bool)preg_match($v, $student->emerg_email)  && $counselor->email != NULL && isset($request->includecounselor) ){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('pemail'=>$student->emerg_email,'cemail'=>$counselor->email))
        ->send(new ApplicationMail($student));
      }else if($counselor->email != NULL && isset($request->includecounselor)){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('cemail'=>$counselor->email))
        ->send(new ApplicationMail($student));
      }else if($student->emerg_email != NULL && (bool)preg_match($v, $student->emerg_email) ){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('pemail'=>$student->emerg_email))
        ->send(new ApplicationMail($student));
        return redirect('/studentdetail/' . $id)->with(['success'=>'Email Sent(sent to student and parent email)']);

      }else if($student->emerg_email == NULL ){
        \Mail::to(array('email'=>$student->email))
        ->send(new ApplicationMail($student));
        return redirect('/studentdetail/' . $id)->with(['success'=>'Email Sent (only sent to student - missing parent email)']);

      }else{
              return redirect('/studentdetail/' . $id)->with(['error'=>'Error sending email']);
      }

      return redirect('/studentdetail/' . $id)->with(['success'=>'Email Sent']);


    }

    public function updatestudentresponse(Request $request)
    {

      $student = student::find($request->id);


      if(isset($request->studentresponse)){
        $student->studentresponse = 'Y';
        $student->studentresponse_at = date("Y-m-d");
        $student->save();
      }else{
        $student->studentresponse = 'N';
        $student->studentresponse_at = NULL;
        $student->save();
      }
      return redirect('/studentdetail/' . $request->id)->with(['success'=>'Student Response Updated']);


    }

    public function updatestudentws(Request $request)
    {

      $student = student::find($request->id);

      if(isset($request->ws1)){
        $student->ws1 = $request->ws1;
        $student->save();
      }
      if(isset($request->ws2)){
        $student->ws2 = $request->ws2;
        $student->save();
      }

                $result = array(
                  'success' => 'Student Updated ' ,
                  'status' => 'success',
                  'action' => 'update',
                );

              //ajaxResponse
              return response()->json($result);


    }

    public function updatestudenttracking(Request $request)
    {

      $student = student::find($request->id);


      if(isset($request->ta)){
        $student->ta = 'Y';
        $student->ta_at = date("Y-m-d");
      }else if(isset($request->la)){
        $student->la = 'Y';
        $student->la_at = date("Y-m-d");
      }else if(isset($request->mock)){
        $student->mock = 'Y';
        $student->mock_at = date("Y-m-d");
      }else if(isset($request->resume)){
        $student->resume = 'Y';
        $student->resume_at = date("Y-m-d");
      }

      $student->save();

      return redirect('/studentdetail/' . $request->id)->with(['success'=>'Student Response Updated']);


    }
    public function updatestudenttrackingAjax(Request $request)
    {

      $student = student::find($request->id);

      if($request->ta == 'true' && $student->ta != 'Y'){
        $student->ta = 'Y';
        $student->ta_at = date("Y-m-d");
      }else if($request->ta == 'false' && $student->ta == 'Y'){
        $student->ta = 'N';
      }
      if($request->la == 'true' && $student->la != 'Y'){
        $student->la = 'Y';
        $student->la_at = date("Y-m-d");
      }
      else if($request->la == 'false' && $student->la == 'Y'){
        $student->la = 'N';
      }
      if($request->mock == 'true' && $student->mock != 'Y'){
        $student->mock = 'Y';
        $student->mock_at = date("Y-m-d");
      }else if($request->mock == 'false' && $student->mock == 'Y'){
        $student->mock = 'N';
      }
      if($request->resume == 'true' && $student->resume != 'Y'){
        $student->resume = 'Y';
        $student->resume_at = date("Y-m-d");
      } else if($request->resume == 'false' && $student->resume == 'Y'){
        $student->resume = 'N';
      }

      $student->save();

          $result = array(
            'success' => 'Student Updated ' ,
            'status' => 'success',
            'action' => 'update',
          );

        //ajaxResponse
        return response()->json($result);


    }

}
