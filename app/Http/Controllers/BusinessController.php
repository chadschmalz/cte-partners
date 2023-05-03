<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\business;
use App\Models\cluster;
use App\Models\pathway;
use App\Models\activity;
use App\Models\poc;
use App\Models\business_activity;
use App\Models\business_pathway;
use App\Models\business_internship;
use App\Models\vbusiness_summary;
use App\Models\semester;
use Auth;
use DB;

use App\Mail\BusinessMail;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedcluster = 'all', $selectedpathway= 'all', $selectedactivity = 'all',Request $request)
    {
      if($request->Status == '')
        $request->Status = '%';

      if($selectedpathway!='all'){
          $selectedcluster = pathway::find($selectedpathway)->cluster_id;
        }

      if(($selectedcluster == NULL  && $selectedpathway== NULL && $selectedactivity == NULL) or ($selectedcluster == 'all'  && $selectedpathway== 'all' && $selectedactivity == 'all')){
               if(Auth::user()->name == 'Chad Schmalz'){
                  $businesses =  business::where('business.name','like','%')->orderBy('business.name', 'asc')
                    ->get();
                    $bizids =  business::where('business.name','like','%')->pluck('id');
                }
                else{
                  
                  $businesses =  business::where('business.name','like','%')->orderBy('business.name', 'asc')
                  ->get();
                  $bizids =  business::where('business.name','like','%')->pluck('id');
                  
                }

      }else if($selectedcluster != NULL && $selectedcluster != 'all' && $selectedpathway== 'all' && $selectedactivity == 'all'){
        $businesses =  business::
          whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->whereNull('deleted_at')->pluck('business_id'))->where('next_internship','like',$request->Status)
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else if($selectedpathway == 'all' && $selectedcluster != 'all' && $selectedactivity != 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->whereNull('deleted_at')->pluck('business_id'))->where('next_internship','like',$request->Status)
          ->whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->whereNull('deleted_at')->pluck('business_id'))
          ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else if($selectedpathway != 'all' && $selectedcluster != 'all' && $selectedactivity != 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->whereNull('deleted_at')->pluck('business_id'))->where('next_internship','like',$request->Status)
          ->whereIn('business.id',business_pathway::where('pathway_id',$selectedpathway)->whereNull('deleted_at')->pluck('business_id'))
          ->whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->whereNull('deleted_at')->pluck('business_id'))
          ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway != 'all' && $selectedcluster != 'all'){

        $businesses =  business::
          whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->pluck('business_id'))
          ->whereIn('business.id',business_pathway::where('pathway_id',$selectedpathway)->pluck('business_id'))
          ->where('next_internship','like',$request->Status)
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway != 'all' && $selectedactivity != 'all'){

        $businesses =  business::
          whereIn('business.id',business_pathway::where('pathway_id',$selectedpathway)->pluck('business_id'))
          ->whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))
          ->where('next_internship','like',$request->Status)
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else if($selectedpathway == 'all' && $selectedcluster == 'all' && $selectedactivity != 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))->where('next_internship','like',$request->Status)
              ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else{
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')->get();
        
          }

      if($selectedcluster==NULL || $selectedcluster=='all')
        $pathways = pathway::where('pathway_desc','like','%')->orderBy('pathway_desc')->get();
      else
        $pathways = pathway::where('cluster_id',$selectedcluster)->orderBy('pathway_desc')->get();

      $clusters = array();
      foreach (cluster::all() as $key => $value) {
        $clusters[$value->id] =  $value;
      }


      $bizactivities = array();
      $bizclusters = array();
      
      // if(Auth::user()->name == 'Chad  Schmalz' && $clusters == 'all'){
        
      //   //use businesscluster view to load list faster
      //   $cs = DB::table('vbusinessclusters')->select(db::raw('business_id, group_concat(cluster_desc) as clusters'))
      //                                   ->whereIn('business_id',$bizids)->groupBy('business_id')->get();
      //   foreach ($cs as $key => $cluster) {
      //     $bizclusters[$cluster->business_id] = $cluster->clusters;
      //   }

      //   //use businessactivity view to load list faster
      //   $acts = DB::table('vbusinessactivities')->select(db::raw('business_id, group_concat(activity_desc) as activities'))
      //   ->whereIn('business_id',$bizids)->groupBy('business_id')->get();
        
      //   foreach ($acts as $key => $activity) {
      //    $bizactivities[$activity->business_id] = $activity->activities;
      //   }

      // }else{
        foreach ($businesses as $key => $biz) {
          $bizactivities[$biz->id] = "";
            $bizclusters[$biz->id] = '';
        
            foreach (business_activity::where('business_id',$biz->id)
                      ->join('activity','business_activities.activity_id','activity.id')
                      ->pluck('activity.activity_desc') as  $act) {
              $bizactivities[$biz->id] .=  $act.",";
            }

            foreach (business_pathway::where('business_id',$biz->id)
            ->whereNull('business_pathways.deleted_at')
            ->whereNull('clusters.deleted_at')->distinct()
            ->join('pathways','business_pathways.pathway_id','pathways.id')
            ->join('clusters','pathways.cluster_id','clusters.id')
            ->pluck('clusters.cluster_desc') as  $clusterdesc) {
              $bizclusters[$biz->id] .=  $clusterdesc.",";
            }   
          }
      // }

// return $bizactivities;
      $data = array(
                  'selectedCluster'=> $selectedcluster,
                  'selectedPathway'=> $selectedpathway,
                  'selectedActivity'=> $selectedactivity,
                  'selectedStatus'=> $request->Status,
                  'clusters'=> $clusters,
                  'pathways'=> $pathways,
                  'bizactivities'=> $bizactivities,
                  'bizclusters'=> $bizclusters,
                  'activitys'=> activity::all(),
                 'businesses'=> $businesses,
                 'page'=> 'WBL Business Partners',
               );
        return view('business')->with($data);
    }
    public function businessActivePathway($selectedcluster = 1, $selectedpathway= 'all', $selectedactivity = 'all',$semester = NULL,Request $request)
    {
      if($request->Status == '')
        $request->Status = '%';

      if($selectedpathway!='all' && $selectedcluster == 'all'){
          $curPathway = pathway::find($selectedpathway);
          $selectedcluster = $curPathway->cluster_id;
        }

        if($semester ==  NULL)
          $semester = semester::where('status','active')->get();
        else {
          $semester = semester::find($semester);
          // code...
        }

      if(($selectedcluster == NULL  && $selectedpathway== NULL && $selectedactivity == NULL) or ($selectedcluster == 'all'  && $selectedpathway== 'all' && $selectedactivity == 'all')){
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')->get();

      }else if($selectedcluster != NULL && $selectedcluster != 'all' && $selectedpathway== 'all' && $selectedactivity == 'all'){
        $businesses =  business::
          whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->pluck('business_id'))->where('next_internship','like',$request->Status)
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->where('business_pathways.begdt','<=',$semester->semester_enddt)
              ->where('business_pathways.enddt','>=',$semester->semester_enddt)
              ->whereNotNull('business_pathways.seats')
              ->where('business_pathways.seats','>',0)
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway != 'all' && $selectedactivity == 'all'){
        $businesses =  business::whereIn('business.id',
          business_pathway::where('pathway_id',$selectedpathway)->where('business_pathways.seats','>',0)
          ->where('business_pathways.begdt','<=',$semester->semester_enddt)
          ->where('business_pathways.enddt','>=',$semester->semester_enddt)
          ->pluck('business_id'))
          ->where('next_internship','like',$request->Status)
              ->orderBy('business.name', 'asc')
              ->get();
              // return $businesses;

      }else if($selectedpathway == 'all' && $selectedcluster == 'all' && $selectedactivity != 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))->where('next_internship','like',$request->Status)
              ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->where('business_pathways.begdt','<=',$semester->semester_enddt)
              ->where('business_pathways.enddt','>=',$semester->semester_enddt)
              ->whereNotNull('business_pathways.seats')
              ->where('business_pathways.seats','>',0)
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else{
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')
                         ->leftJoin('business_pocs',function($query){
                          $query->on('business_pocs.business_id','=','business.id');
                            $query->limit(1);
                            //$query->min('photos.created_at');
                          })
        ->get();
          }

      if($selectedcluster==NULL || $selectedcluster=='all')
        $pathways = pathway::where('pathway_desc','like','%')->orderBy('pathway_desc')->get();
      else
        $pathways = pathway::where('cluster_id',$selectedcluster)->orderBy('pathway_desc')->get();

      $clusters = array();
      foreach (cluster::all() as $key => $value) {
        $clusters[$value->id] =  $value;
      }

      $data = array(
                  'selectedCluster'=> $selectedcluster,
                  'selectedPathway'=> $selectedpathway,
                  'selectedActivity'=> $selectedactivity,
                  'selectedStatus'=> $request->Status,
                  'clusters'=> $clusters,
                  'pathways'=> $pathways,
                  'activitys'=> activity::all(),
                 'businesses'=> $businesses,
               );
        return view('business')->with($data);
    }
    public function allpocs($selectedcluster = NULL, $selectedpathway= NULL, $selectedactivity = NULL)
    {


      if($selectedpathway!='all' && $selectedcluster == 'all'){
          $selectedcluster = pathway::find($selectedpathway)->cluster_id;
        }

      if($selectedcluster == NULL && $selectedpathway== NULL && $selectedactivity == NULL){
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')->get();
      }else if($selectedcluster != NULL && $selectedpathway== 'all' && $selectedactivity == 'all'){
        $businesses =  business::
          whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->pluck('business_id'))
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway != 'all' && $selectedactivity == 'all'){
        $businesses =  business::
          whereIn('business.id',business_pathway::where('pathway_id',$selectedpathway)->pluck('business_id'))
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway == 'all' && $selectedcluster == 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))
              ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else{
      $businesses =  business::
      whereIn('business.id',business_pathway::where('pathway_id','like',$selectedpathway=='all'||$selectedpathway==NULL?'%':$selectedpathway)->pluck('business_id'))
      ->whereIn('business.id',business_activity::where('activity_id', $selectedactivity=='all'||$selectedactivity==NULL?'%':$selectedactivity)->pluck('business_id'))
            ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
            ->select( 'business.*')
            ->distinct()
            ->orderBy('business.name', 'asc')
            ->get();
          }

      if($selectedcluster==NULL || $selectedcluster=='all')
        $pathways = pathway::where('pathway_desc','like','%')->orderBy('pathway_desc')->get();
      else
        $pathways = pathway::where('cluster_id',$selectedcluster)->orderBy('pathway_desc')->get();

      $clusters = array();
      foreach (cluster::all() as $key => $value) {
        $clusters[$value->id] =  $value;
      }

      $data = array(
                  'selectedCluster'=> $selectedcluster,
                  'selectedPathway'=> $selectedpathway,
                  'selectedActivity'=> $selectedactivity,
                  'clusters'=> $clusters,
                  'pathways'=> $pathways,
                  'activitys'=> activity::all(),
                 'businesses'=> $businesses,
                 'page'=> 'WBL ALL POCs',
               );
        return view('allContacts')->with($data);
    }
    public function address($selectedcluster = NULL, $selectedpathway= NULL, $selectedactivity = NULL)
    {


      if($selectedpathway!='all' && $selectedcluster == 'all'){
          $selectedcluster = pathway::find($selectedpathway)->cluster_id;
        }

      if($selectedcluster == NULL && $selectedpathway== NULL && $selectedactivity == NULL){
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')->get();
      }else if($selectedcluster != NULL && $selectedpathway== 'all' && $selectedactivity == 'all'){
        $businesses =  business::
          whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->pluck('business_id'))
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway != 'all' && $selectedactivity == 'all'){
        $businesses =  business::
          whereIn('business.id',business_pathway::where('pathway_id',$selectedpathway)->pluck('business_id'))
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway == 'all' && $selectedcluster == 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))
              ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else{
      $businesses =  business::
      whereIn('business.id',business_pathway::where('pathway_id','like',$selectedpathway=='all'||$selectedpathway==NULL?'%':$selectedpathway)->pluck('business_id'))
      ->whereIn('business.id',business_activity::where('activity_id', $selectedactivity=='all'||$selectedactivity==NULL?'%':$selectedactivity)->pluck('business_id'))
            ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
            ->select( 'business.*')
            ->distinct()
            ->orderBy('business.name', 'asc')
            ->get();
          }

      if($selectedcluster==NULL || $selectedcluster=='all')
        $pathways = pathway::where('pathway_desc','like','%')->orderBy('pathway_desc')->get();
      else
        $pathways = pathway::where('cluster_id',$selectedcluster)->orderBy('pathway_desc')->get();


      $data = array(
                  'selectedCluster'=> $selectedcluster,
                  'selectedPathway'=> $selectedpathway,
                  'selectedActivity'=> $selectedactivity,
                  'clusters'=> cluster::all(),
                  'pathways'=> $pathways,
                  'activitys'=> activity::all(),
                 'businesses'=> $businesses,
               );
        return view('businessaddress')->with($data);
    }
    public function businessdetail($id)
    {

      $business =  business::find($id);

      $pathways = pathway::where('pathway_desc','like','%' )->orderBy('pathway_desc')->get();
      // return $pathways;
      $activitys = activity::all();

      $data = array(
        'pathways'=> $pathways,
        'activitys'=> $activitys,
        'business'=> $business,
        'page'=> 'WBL '.$business->name,

                 'pathways'=> pathway::where('id','like','%')->orderBy('pathway_desc')->get(),
               );
        return view('businessdetail')->with($data);
    }
    public function addpathway(Request $request)
    {
      $business =  business::find($request->bizid);

        $clusterid = pathway::find($request->pathway_id)->cluster->id;

        $newpath = new business_pathway;
        $newpath->business_id = $request->bizid;
        $newpath->cluster_id = $clusterid;
        $newpath->begdt = date('Y-m-d',strtotime($request->begdt));
        $newpath->enddt = date('Y-m-d',strtotime($request->enddt));
        $newpath->seats = $request->seats;
        $newpath->pathway_id = $request->pathway_id;
        $newpath->save();

      $data = array(
                 'business'=> $business,
               );
        return redirect('/businessdetail/'.$request->bizid);
    }
    public function updatepathway(Request $request)
    {

        $clusterid = pathway::find($request->pathway_id)->cluster->id;

        $path = business_pathway::find($request->pathwayRecordid);
        $path->cluster_id = $clusterid;
        $path->begdt = date('Y-m-d',strtotime($request->begdt));
        $path->enddt = date('Y-m-d',strtotime($request->enddt));
        $path->seats = $request->seats;
        $path->pathway_id = $request->pathway_id;
        $path->save();

        return redirect('/businessdetail/'.$request->bizid);
    }
    public function pathwayupdate(Request $request)
    {

      $business =  business::find($request->bizid);

      $deletedRows = business_pathway::where('business_id', $request->bizid)->delete();

      foreach($request->pathways as $path)
      {
        $clusterid = pathway::find($path)->cluster->id;

        $newpath = new business_pathway;
        $newpath->business_id = $request->bizid;
        $newpath->cluster_id = $clusterid;
        $newpath->pathway_id = $path + 0;
        $newpath->save();
      }

      $data = array(
                 'business'=> $business,
               );
        return redirect('/businessdetail/'.$request->bizid);
    }
    public function involvementupdate(Request $request)
    {

      $business =  business::find($request->bizid);

      $deletedRows = business_activity::where('business_id', $request->bizid)->delete();
      if(isset($request->activitys)){
        foreach($request->activitys as $act)
        {
          $newact = new business_activity;
          $newact->business_id = $request->bizid;
          $newact->activity_id = $act + 0;
          $newact->save();
        }
      }

      $data = array(
                 'business'=> $business,
               );
        return redirect('/businessdetail/'.$request->bizid);
    }

    public function internshipadd(Request $request)
    {

        $newinternship = new business_internship;
        $newinternship->business_id = $request->bizid;
        $newinternship->position_title = $request->interntitle;
        $newinternship->tier = $request->tier;
        $newinternship->entry_point = $request->entry_point;
        $newinternship->intern_length = $request->length;
        $newinternship->contact_method = $request->contact_method;
        $newinternship->notes = $request->internshipnotes;
        $newinternship->save();


        return redirect('/businessdetail/'.$request->bizid);
    }
    public function internshipupdate(Request $request)
    {

        $internship = business_internship::find($request->internid);
        $internship->position_title = $request->position_title;
        $internship->pathway_id = $request->pathway_id;
        $internship->tier = $request->tier;
        $internship->entry_point = $request->entry_point;
        $internship->intern_length = $request->length;
        $internship->contact_method = $request->contact_method;
        $internship->notes = $request->internshipnotes;
        $internship->save();


        return redirect('/businessdetail/'.$request->bizid);
    }

    public function internshipdestroy(Request $request,$id)
    {
      business_internship::destroy($id);
      return redirect('/businessdetail/'.$request->bizid);
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

            $business = new business;

            $business->name = $request->bizname;
            $business->address = $request->bizaddress;
            $business->city = $request->bizcity;
            $business->state = $request->bizstate;
            $business->zip = $request->bizzip;
            $business->notes = $request->biznotes;
            $business->next_internship = $request->next_internship;
            if(isset($request->agreement)){
              $business->safety_agreement = 'Y';
            }else{
              $business->safety_agreement = 'N';

            }
            $business->save();

            $poc = new poc;

            $poc->business_id = $business->id;
            $poc->name = $request->pocname;
            $poc->email = $request->email;
            $poc->phone = $request->phone;
            $poc->notes = $request->notes;
            if(isset($request->mentor)){
              $poc->mentor = 'Y';
            }else{
              $poc->mentor = '';

            }
            $poc->save();

            return redirect('/businessdetail/'.$business->id);
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
    public function downloadsamplepartner()
    {
      $file="samplePartner.csv";
      return Storage::download($file);
    }
    public function uploadpartners(Request $request)
    {
      $path = Storage::putFileAs('partners', $request->file('partnersfile'),'newpartners.csv');
      $contents = file(Storage::path($path));

      foreach($contents as $line) {
        if(count(explode(',',$line))<>9){
          $clusters =  cluster::all();
         return view('utils')->with(['clusters'=>$clusters,'uploadFailed'=>'One or more lines have the wrong number of fields. Each line should have 8 commas.']);
       }
       }
     foreach($contents as $line) {
//name,Safety Agreement,Street Address,City,State,Zip,POC,Email,Phone
           list($bizName, $bizAgreement, $bizaddress,$bizcity,$bizstate,$bizZip, $pocName, $pocPhone, $pocEmail) = explode(',',$line);
           if($bizName == 'name') continue;
           // if(strlen($bizAgreement) >0){
           //   return $line;
           // }
           // return '"'.$bizAgreement.'"';

           // return 'safety_agreement not blank';

             $business = new business;

             $business->name = $bizName;
             $business->address = $bizaddress;
             $business->city = $bizcity;
             $business->state = $bizstate;
             // $business->notes = $bizNotes;
             // $business->next_internship = $bizNext;
             if(strlen($bizAgreement) >0){
               $business->safety_agreement = 'Y';
             }
             $business->save();

             $poc = new poc;

             $poc->business_id = $business->id;
             $poc->name = $pocName;
             $poc->email = $pocEmail;
             $poc->phone = $pocPhone;
             // $poc->notes = $pocNotes;
             // $poc->mentor = $pocMentor;
             $poc->save();
             

      }
      $clusters =  cluster::all();
      $data = array(
                 'clusters'=> $clusters,
                 'bizuploadMessage'=>'Import Successful'
               );
      return view('utils')->with($data);
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

      $business = business::find($request->bizid);

      $business->name = $request->bizname;
      $business->address = $request->bizaddress;
      $business->city = $request->bizcity;
      $business->state = $request->bizstate;
      $business->zip = $request->bizzip;
      $business->notes = $request->biznotes;
      $business->next_internship = $request->next_internship;
      if(isset($request->agreement)){
        $business->safety_agreement = 'Y';
      }else{
        $business->safety_agreement = 'N';

      }
      $business->save();


      return redirect('/businessdetail/'.$request->bizid);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $biz = business::find($id);
      
      if(count($biz->studentinternships) > 0)
        return redirect('/businessdetail/'.$id)->with(['error'=>'Unable to delete: Business is assigned to one or more students.']); 
      
      business::destroy($id);
      
      return redirect('/')->with(['success'=>'Business Removed Successfully.']);
    }
    public function restore(Request $request)
    {
      business::withTrashed()->find($request->bizid)->restore();
       return redirect('/');
    }

    public function removed($selectedcluster = NULL, $selectedpathway= NULL, $selectedactivity = NULL)
    {


      if($selectedpathway!='all' && $selectedcluster == 'all'){
          $selectedcluster = pathway::find($selectedpathway)->cluster_id;
        }

      if($selectedcluster == NULL && $selectedpathway== NULL && $selectedactivity == NULL){
        $businesses =  business::onlyTrashed()->where('name','like','%')->orderBy('name', 'asc')->get();
      }else if($selectedcluster != NULL && $selectedpathway== 'all' && $selectedactivity == 'all'){
        $businesses =  business::onlyTrashed()->
          whereIn('business.id',business_pathway::where('cluster_id',$selectedcluster)->pluck('business_id'))
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway != 'all' && $selectedactivity == 'all'){
        $businesses =  business::onlyTrashed()->
          whereIn('business.id',business_pathway::where('pathway_id',$selectedpathway)->pluck('business_id'))
              ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }else if($selectedpathway == 'all' && $selectedcluster == 'all'){
        $businesses =  business::onlyTrashed()->
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))
              ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else{
      $businesses =  business::onlyTrashed()->
      whereIn('business.id',business_pathway::where('pathway_id','like',$selectedpathway=='all'||$selectedpathway==NULL?'%':$selectedpathway)->pluck('business_id'))
      ->whereIn('business.id',business_activity::where('activity_id', $selectedactivity=='all'||$selectedactivity==NULL?'%':$selectedactivity)->pluck('business_id'))
            ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
            ->select( 'business.*')
            ->distinct()
            ->orderBy('business.name', 'asc')
            ->get();
          }

      if($selectedcluster==NULL || $selectedcluster=='all')
        $pathways = pathway::all();
      else
        $pathways = pathway::where('cluster_id',$selectedcluster)->get();


      $data = array(
                  'selectedCluster'=> $selectedcluster,
                  'selectedPathway'=> $selectedpathway,
                  'selectedActivity'=> $selectedactivity,
                  'clusters'=> cluster::all(),
                  'pathways'=> $pathways,
                  'activitys'=> activity::all(),
                 'businesses'=> $businesses,
               );
        return view('removedpartners')->with($data);
    }

    public function search(Request $request) {

              $validator = \Validator::make($request->all(), [
                'searchInput' => 'required',
              ]);

              if ($validator->fails())
              {

                $businesses=business::paginate(10)->get();

                $result = array(
                  'status' => 'Failed',
                  'action' => 'search',
                  'employers'=>$businesses,
                  'total_count'=>count($businesses),
                  'errors'=>$validator->errors()->all()
                );
                return response()->json($result);
              }

            $businesses = business::where(function ($query) use ($request) {
                                          $query->where('name','like','%'.$request->searchInput.'%');
                                                // ->orWhere('name','like','%'.$request->searchInput.'%')
                                                // ->orWhere('name','like','%'.$request->searchInput.'%');
                                      })
                                      ->get();




              $result = array(
                'success' => 'Search successful.',
                'status' => 'success',
                'action' => 'search',
                'employers'=>$businesses,
                'total_count'=>count($businesses),



              );


              return response()->json($result);
    }

    public function businessemail($id,Request $request)
    {
return $request;
      $business = business::find($id);
 

   // if(Auth::user()->name == 'Chad Schmalz'){
        //         Mail::raw([], function($message) {
        //           $message->from('washk12internships@washk12.org', 'WCSD WBL');
        //           $message->to('chad.schmalz@washk12.org');
        //           $message->subject('Internship Update');
        //           $message->setBody( '5% off its awesome Go get it now !' );
        //           $message->addPart("5% off its awesome\n\nGo get it now!", 'text/plain');
        //       });
        //               return redirect('/studentdetail/' . $id)->with(['success'=>'Simple Text Email Sent']);
        // }

      $v = "/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/";
      if($request->emailtype == 'placement'){
            if($business->pocs->where('mentor','Y')->email != NULL && (bool)preg_match($v, $business->pocs->where('mentor','Y')->email)){
              \Mail::to(array('email'=>'chad.schmalz@washk12.org'))
              ->send(new BusinessMail($business));
              return redirect('/studentdetail/' . $id)->with(['success'=>'Acceptance Email Sent(sent to student and parent and councilor email)']);
            }

            return redirect('/studentdetail/' . $id)->with(['error'=>'Email Error']);
        }else if($request->emailtype == 'futureacceptance'){
              }else if($request->emailtype == 'l2accepted'){
              if($student->emerg_email != NULL && (bool)preg_match($v, $student->emerg_email)  && $counselor->email != NULL && isset($request->includecounselor) ){
                \Mail::to(array('email'=>$student->email))
                ->cc(array('pemail'=>$student->emerg_email,'cemail'=>$counselor->email,'coachemail'=>'mike.hassler@washk12.org'))
                ->send(new L2AcceptanceMail($student));
                return redirect('/studentdetail/' . $id)->with(['success'=>'L2 Acceptance Email Sent(sent to student and parent and councilor email)']);
              }else if(isset($counselor) && $counselor->email != NULL && isset($request->includecounselor)){
                \Mail::to(array('email'=>$student->email))
                ->cc(array('cemail'=>$counselor->email,'coachemail'=>'mike.hassler@washk12.org'))
                ->send(new L2AcceptanceMail($student));
                return redirect('/studentdetail/' . $id)->with(['success'=>'L2 Acceptance Email Sent(sent to student and councilor email)']);
              }else if($student->emerg_email != NULL && (bool)preg_match($v, $student->emerg_email) ){
                \Mail::to(array('email'=>$student->email))
                ->cc(array('pemail'=>$student->emerg_email,'coachemail'=>'mike.hassler@washk12.org'))
                ->send(new L2AcceptanceMail($student));
                return redirect('/studentdetail/' . $id)->with(['success'=>'L2 Acceptance Email Sent(sent to student and parent email)']);

              }else if($student->emerg_email == NULL ){
                \Mail::to(array('email'=>$student->email))
                ->cc(array('coachemail'=>'mike.hassler@washk12.org'))
                ->send(new L2AcceptanceMail($student));
                return redirect('/studentdetail/' . $id)->with(['success'=>'L2 Acceptance Email Sent (only sent to student - missing parent email)']);

              }else{
                      return redirect('/studentdetail/' . $id)->with(['error'=>'Error sending email']);
              }

              return redirect('/studentdetail/' . $id)->with(['success'=>'Email Sent']);
          }

    }

}
