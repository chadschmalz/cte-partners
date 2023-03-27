<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Auth;

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
use App\Mail\FutureApplicationMail;
use App\Mail\DeferMail;
use App\Mail\SeatsFullMail;
use App\Mail\L2AcceptanceMail;
use App\Mail\RegistrationExpiredMail;

use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedSemester = 'unassigned',$selectedLocation = 'all', $selectedPathway= 'all', $selectedCluster= 'all', Request $request )
    {
        $students = [];
        if($selectedSemester== NULL){

          $selectedSemester = semester::where('status','active')->get()[0]->id;
        }
        $selectedLocation == 'all' ? $selectedLocation = '%' : '';
        $selectedPathway == 'all' ? $selectedPathway = '%' : '';
        $selectedCluster == 'all' ? $selectedCluster = '%' : '';



          if($selectedSemester == 'unassigned' && $selectedLocation == '%' &&  $selectedPathway == '%') {
             $students =  student::where('onboarding', 'Y')->get();
           }
           else if($selectedSemester == 'unassigned' && $selectedLocation != '%' &&  $selectedPathway == '%'){
             $students =  student::where('location_id',$selectedLocation)->where('onboarding', 'Y')->get();
           }
           else if($selectedSemester == 'dropped' && $selectedLocation == '%' &&  $selectedPathway == '%') {
              $students =  student::where('dropped', 'Y')->get();
            }
            else if($selectedSemester == 'dropped' && $selectedLocation != '%' &&  $selectedPathway == '%'){
              $students =  student::where('location_id',$selectedLocation)->where('dropped', 'Y')->get();
            }
            else{
              $students =     student::where('location_id','like',$selectedLocation)->where('student_semesters.pathway_id','like',$selectedPathway)
              ->join('student_semesters','student_semesters.student_id','students.id')->whereNULL('student_semesters.deleted_at')
              ->join('pathways','pathways.id','student_semesters.pathway_id')
              ->join('clusters','clusters.id','pathways.cluster_id')->where('clusters.id','like',$selectedCluster)
              ->where('student_semesters.semester_id',$selectedSemester)
              ->select('students.*')->orderBy('students.name','asc')->get();
            }




            $data = array(
                        'selectedSemester'=> $selectedSemester,
                        'selectedPathway'=> $selectedPathway,
                        'selectedCluster'=> $selectedCluster,
                        'selectedLocation'=> $selectedLocation,
                        'clusters'=> cluster::all(),
                        'pathways'=> pathway::orderBy('pathway_desc')->get(),
                        'locations'=> location::where('location_desc','like','%')->orderBy('location_desc')->get(),
                        'semesters'=> semester::where('id','like','%')->orderBy('semester_enddt')->get(),
                       'students'=> $students,
                'page'=> 'WBL Students',
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
        'locations'=> location::where('location_desc','like','%')->orderBy('location_desc')->get(),
         'student'=> $student,
         'counselors'=> counselor::where('location_id',$student->location_id)->get(),
        //  'semesters'=>semester::where('semester_enddt','>=',date("Y-m-d H:i:s"))->orderBy('semester_enddt')->get(),
         'semesters'=>semester::where('semester_enddt','like','%')->orderBy('semester_enddt')->get(),
        'page'=> 'WBL Student '.$student->name,
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
      $student->email = trim($request->stemail);
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
    public function backtounassigned($id)
    {
      $student = student::find($id);

      $student->onboarding = 'Y';
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
            $studentSem->schedule =  $request->schedule;
            $studentSem->pathway_id =  $request->pathway_id;
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


      $email = new ApplicationMail($student,'emails.'.$request->emailtype);
      $emailType = '';

      if($request->emailtype == "acceptedinperson" )
        $emailType = "Accepted In-Person"; 
      else if($request->emailtype == "l1onlinews" )
        $emailType = "L1 Accepted Online"; 
      else if($request->emailtype == "l2onlinews" )
        $emailType = "L2 Accepted Online"; 
      else if($request->emailtype == "deferinperson" )
        $emailType = "Deferral In-Person"; 
      else if($request->emailtype == "deferonlinews" )
        $emailType = "Deferral Online"; 
      else if($request->emailtype == "prereqrequired" )
        $emailType = "Prerequisite Required" ; 
      else if($request->emailtype == "regexpired" )
        $emailType = "Priority Registration Expired" ; 
      
      $v = "/[a-zA-Z0-9_\-\..+]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/";

      if (!(bool)preg_match($v, $student->email))
        return redirect('/studentdetail/' . $id)->with(['error'=>'Student email Error ('.$student->email.'). Email not sent']);
      else if (!(bool)preg_match($v, $student->emerg_email))
        return redirect('/studentdetail/' . $id)->with(['error'=>'Parent email Error('. $student->emerg_email .')_. Email not sent']);

      if(Auth::user()->name == 'Chad Schmalz' ){
        \Mail::to(array('email'=>'chad.schmalz@washk12.org'))
        ->send($email);
        return redirect('/studentdetail/' . $id)->with(['success'=>$emailType . '  Sent(sent to student and parent and councilor email)']);
      }
  
      if($student->emerg_email != NULL && (bool)preg_match($v, $student->emerg_email)  && $counselor->email != NULL && isset($request->includecounselor) ){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('pemail'=>$student->emerg_email,'cemail'=>$counselor->email,'coachemail'=>'mike.hassler@washk12.org'))
        ->send($email);
        return redirect('/studentdetail/' . $id)->with(['success'=>$emailType . '  Sent(sent to student and parent and councilor email)']);
      }else if(isset($counselor) && $counselor->email != NULL && isset($request->includecounselor)){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('cemail'=>$counselor->email,'coachemail'=>'mike.hassler@washk12.org'))
        ->send($email);
        return redirect('/studentdetail/' . $id)->with(['success'=>$emailType . '  Sent(sent to student and councilor email)']);
      }else if($student->emerg_email != NULL && (bool)preg_match($v, $student->emerg_email) ){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('pemail'=>$student->emerg_email,'coachemail'=>'mike.hassler@washk12.org'))
        ->send($email);
        return redirect('/studentdetail/' . $id)->with(['success'=>$emailType . '  Sent(sent to student and parent email)']);

      }else if($student->emerg_email == NULL ){
        \Mail::to(array('email'=>$student->email))
        ->cc(array('coachemail'=>'mike.hassler@washk12.org'))
        ->send($email);
        return redirect('/studentdetail/' . $id)->with(['success'=>$emailType . '  Sent (only sent to student - missing parent email)']);

      }else{
              return redirect('/studentdetail/' . $id)->with(['error'=>'Error sending email']);
      }


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

      if($request->dropped == 'true' && $student->dropped != 'Y'){
        $student->dropped = 'Y';
        $student->dropped_at = date("Y-m-d");
      } else if($request->dropped == 'false' && $student->dropped == 'Y'){
        $student->dropped = 'N';
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

    public function studentapplications(Request $request,$year=2022){

       

      $locations = [];
      $semestertotals = [];
      $semesters = [];
      foreach(location::where('location_desc','like','%')->orderBy('location_desc')->get() as $l)
        $locations[$l->id] = $l;

      foreach(semester::where('semesters.semester_enddt', '>=',$year.'-01-01')->where('semesters.semester_enddt', '<=', $year.'-12-31')->get() as $sem)
        $semesters[$sem->id] = $sem;

        foreach( DB::table('semesters')
      ->join('student_semesters','student_semesters.semester_id','semesters.id')->whereNull('student_semesters.deleted_at')
      ->join('students','students.id','student_semesters.student_id')->whereNull('students.deleted_at')
      ->where('semesters.semester_enddt', '>=',$year.'-01-01')->where('semesters.semester_enddt', '<=', $year.'-12-31')
      ->select('students.location_id','semesters.id', DB::raw(' count(students.id) as cnt'))
      ->groupby('students.location_id','semesters.id')
      ->get() as $s)
        $semestertotals[$s->location_id][$s->id] = $s->cnt;


      $data = array(
        'schooltotals'=> DB::table('students')->where(DB::raw('year(created_at)'), $year)->whereNull('students.deleted_at')
        ->select( DB::raw('location_id,sum(case when month(created_at) = 1 then 1 else 0 end) as JanCount,
        sum(case when month(created_at) = 2 then 1 else 0 end) as FebCount,
        sum(case when month(created_at) = 3 then 1 else 0 end) as MarCount,
        sum(case when month(created_at) = 4 then 1 else 0 end) as AprCount,
        sum(case when month(created_at) = 5 then 1 else 0 end) as MayCount,
        sum(case when month(created_at) = 6 then 1 else 0 end) as JunCount,
        sum(case when month(created_at) = 7 then 1 else 0 end) as JulCount,
        sum(case when month(created_at) = 8 then 1 else 0 end) as AugCount,
        sum(case when month(created_at) = 9 then 1 else 0 end) as SepCount,
        sum(case when month(created_at) = 10 then 1 else 0 end) as OctCount,
        sum(case when month(created_at) = 11 then 1 else 0 end) as NovCount,
        sum(case when month(created_at) = 12 then 1 else 0 end) as DecCount'))
        ->groupBy(DB::raw('location_id'))
        ->get() ,
        'totals'=> DB::table('students')->where(DB::raw('year(created_at)'), $year)->whereNull('students.deleted_at')
        ->select( DB::raw('sum(case when month(created_at) = 1 then 1 else 0 end) as JanCount,
        sum(case when month(created_at) = 2 then 1 else 0 end) as FebCount,
        sum(case when month(created_at) = 3 then 1 else 0 end) as MarCount,
        sum(case when month(created_at) = 4 then 1 else 0 end) as AprCount,
        sum(case when month(created_at) = 5 then 1 else 0 end) as MayCount,
        sum(case when month(created_at) = 6 then 1 else 0 end) as JunCount,
        sum(case when month(created_at) = 7 then 1 else 0 end) as JulCount,
        sum(case when month(created_at) = 8 then 1 else 0 end) as AugCount,
        sum(case when month(created_at) = 9 then 1 else 0 end) as SepCount,
        sum(case when month(created_at) = 10 then 1 else 0 end) as OctCount,
        sum(case when month(created_at) = 11 then 1 else 0 end) as NovCount,
        sum(case when month(created_at) = 12 then 1 else 0 end) as DecCount'))
        ->get() ,
        'semesters' => $semesters,
        'semestertotals'=> $semestertotals,
        'selectedyear'=> $year,
        'years'=> student::distinct()->select(DB::raw('year(created_at) as year'))->orderby('year')->get(),
        'locations'=> $locations,
        'page'=> 'WBL Enroll Report',
      );
        return view('reports.studentapplications')->with($data);

       
    }

    public function studentclusters(Request $request,$selectedsemester=NULL){

       if($selectedsemester == NULL)
        $selectedsemester = semester::where('status', 'active')->get()[0]->id;
      

      $locations = [];
      $semestertotals = [];
      $semesters = [];
      $clustertotals = [];
      foreach(location::where('location_desc','like','%')->orderBy('location_desc')->get() as $l)
        $locations[$l->id] = $l;

      foreach(semester::all() as $sem)
        $semesters[$sem->id] = $sem;
      foreach(cluster::all() as $c){
        $clusters[$c->id] = $c;
        $clustertotals[$c->id] = 0;
        foreach(location::where('location_desc','like','%')->orderBy('location_desc')->get() as $l){
          $semestertotals[$l->id][$c->id] = DB::table('students')
                                              ->join('student_semesters','student_semesters.student_id','students.id')->whereNull('student_semesters.deleted_at')
                                              ->join('pathways','pathways.id','student_semesters.pathway_id')->whereNull('students.deleted_at')
                                              ->join('clusters','clusters.id','pathways.cluster_id')
                                              ->where('student_semesters.semester_id', $selectedsemester)
                                              ->where('clusters.id', $c->id)
                                              ->where('students.location_id', $l->id)
                                              ->select('clusters.id')
                                              ->groupby('clusters.id')
                                              ->count();
          $clustertotals[$c->id] += $semestertotals[$l->id][$c->id];
        }
      }

      $data = array(
        
        'semesters' => $semesters,
        'clusters' => $clusters,
        'semestertotals'=> $semestertotals,
        'clustertotals'=> $clustertotals,
        'selectedsemester'=> $selectedsemester,
        'years'=> student::distinct()->select(DB::raw('year(created_at) as year'))->orderby('year')->get(),
        'locations'=> $locations,
        'page'=> 'WBL Enroll Report',
      );
        return view('reports.studentclusters')->with($data);

       
    }
}
