<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use Illuminate\Http\Request;
use App\Models\event;
use App\Models\student;
use App\Models\cluster;
use App\Models\pathway;
use App\Models\activity;
use App\Models\location;
use App\Models\semester;
use App\Models\conesite;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedsemester = null,$selectedConesite = 'all', $selectedCluster= 'all', Request $request )
    {
        $events = array();
        if($selectedsemester== NULL){

          $selectedsemester = semester::where('status','active')->get()[0]->id;
        }
        $selectedsemester == 'all' ? $selectedsemester = '%' : '';
        $selectedConesite == 'all' ? $selectedConesite = '%' : '';
        // $selectedPathway == 'all' ? $selectedPathway = '%' : '';
        $selectedCluster == 'all' ? $selectedCluster = '%' : '';



        if($selectedsemester == '%' && $selectedConesite == '%' &&  $selectedCluster == '%') {
             $events =  event::where('id','like','%')->orderBy('event_dt')->paginate(15);
           }
           else if($selectedsemester == '%' && ($selectedConesite != '%' ||  $selectedCluster != '%')){
            $events =  event::whereIn('location_id', conesite::join('locations','locations.conesite_id','conesites.id')->where('conesites.id',$selectedConesite)->pluck('locations.id'))
                                 ->where('cluster_id','like',$selectedCluster)->orderBy('event_dt')
                                 ->paginate(15);
          }
           else if($selectedsemester != '%' || $selectedConesite != '%' ||  $selectedCluster != '%'){
            
              $events =  event::whereIn('location_id', conesite::join('locations','locations.conesite_id','conesites.id')->where('conesites.id','like',$selectedConesite)->pluck('locations.id'))
                                    ->where('cluster_id','like',$selectedCluster)
                                    ->where('event_dt','>=',date('Y-m-d',strtotime(semester::where('id','like',$selectedsemester)->pluck('semester_startdate')[0])))
                                    ->where('event_dt',"<=",date('Y-m-d',strtotime(semester::where('id','like',$selectedsemester)->pluck('semester_enddt')[0])))
                                    ->orderBy('event_dt')->paginate(15);
           }
          
           

            $data = array(
                        'selectedSemester'=> $selectedsemester,
                        // 'selectedPathway'=> $selectedPathway,
                        'selectedCluster'=> $selectedCluster,
                        'selectedLocation'=> $selectedConesite,
                        'activities'=> activity::all(),
                        'clusters'=> cluster::all(),
                        'pathways'=> pathway::orderBy('pathway_desc')->get(),
                        'locations'=> conesite::where('conesite_desc','like','%')->orderBy('conesite_desc')->get(),
                        'semesters'=> semester::where('id','like','%')->orderBy('semester_enddt')->get(),
                        'events'=> $events,
                        'page'=> 'WBL Events',
              );
              return view('event.events')->with($data);

    }

    public function add(){


      $data = array(
        'activities'=> activity::all(),
        'clusters'=> cluster::all(),
        'pathways'=> pathway::orderBy('pathway_desc')->get(),
        'locations'=> location::where('location_desc','like','%')->orderBy('location_desc')->get(),
        'semesters'=> semester::where('id','like','%')->orderBy('semester_enddt')->get(),
        'event'=> NULL,
        'mode'=> 'add',
        'page'=> 'WBL Event Add',
      );
      return view('event.form')->with($data);

    }

    public function edit($id = 1){

 
      $data = array(
        'activities'=> activity::all(),
        'clusters'=> cluster::all(),
        'pathways'=> pathway::orderBy('pathway_desc')->get(),
        'locations'=> location::where('location_desc','like','%')->orderBy('location_desc')->get(),
        'semesters'=> semester::where('id','like','%')->orderBy('semester_enddt')->get(),
        'event'=> event::find($id),
        'mode'=> 'edit',
        'page'=> 'WBL Event Edit',
      );
      return view('event.form')->with($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new event;

        $event->event_desc = $request->event_desc;
        $event->event_dt = $request->event_dt;
        $event->activity_id = $request->activity_id;
        $event->location_id = $request->location_id;
        $event->business_id = $request->business_id;
        $event->pathway_id = $request->pathway_id;
        $event->cluster_id = pathway::find($request->pathway_id)->cluster_id;
        if(isset($request->grades))
         $event->grades = implode(",",$request->grades);
        $event->notes = $request->notes;
        $event->save();
        // $event->school_year = $request->school_year;
        return redirect('/events');
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
      $event = event::find($request->event_id);

      $event->event_desc = $request->event_desc;
      $event->event_dt = $request->event_dt;
      $event->activity_id = $request->activity_id;
      $event->location_id = $request->location_id;
      $event->business_id = $request->business_id;
      $event->pathway_id = $request->pathway_id;
      $event->cluster_id = pathway::find($request->pathway_id)->cluster_id;
      if(isset($request->grades))
        $event->grades = implode(",",$request->grades);
      $event->notes = $request->notes;
      $event->save();

      return redirect('/events');
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


    public function eventreport(Request $request,$selectedsemester=NULL){

      if($selectedsemester == NULL)
       $selectedsemester = semester::where('status', 'active')->get()[0]->id;
     

     $locations = [];
     $conesites = [];
     $semestertotals = [];
     $semesters = [];
     $clustertotals = [];
    //  foreach(location::where('location_desc','like','%')->orderBy('location_desc')->get() as $l)
    //    $locations[$l->id] = $l;

      

     foreach(semester::all() as $sem)
       $semesters[$sem->id] = $sem;
     foreach(cluster::all() as $c){
       $clusters[$c->id] = $c;
       $clustertotals[$c->id] = 0;
       foreach(conesite::where('conesite_desc','like','%')->orderBy('conesite_desc')->get() as $cl){
        $conesites[$cl->id] = $cl;
         $semestertotals[$cl->id][$c->id] = DB::table('events')->whereNull('events.deleted_at')
                                             ->join('locations','locations.id','events.location_id')->whereNull('locations.deleted_at')
                                             ->join('conesites','conesites.id','locations.conesite_id')
                                             ->join('clusters','clusters.id','events.cluster_id')
                                             ->where('clusters.id', $c->id)
                                             ->where('conesites.id', $cl->id)
                                             ->select('events.cluster_id')
                                             ->groupby('clusters.cluster_desc' , 'clusters.id' , 'conesites.conesite_desc')->count();
         $clustertotals[$c->id] += $semestertotals[$cl->id][$c->id];
       }
     }

     $data = array(
       
       'semesters' => $semesters,
       'clusters' => $clusters,
       'semestertotals'=> $semestertotals,
       'clustertotals'=> $clustertotals,
       'selectedsemester'=> $selectedsemester,
       'years'=> student::distinct()->select(DB::raw('year(created_at) as year'))->orderby('year')->get(),
       'locations'=> $conesites,
       'page'=> 'WBL Enroll Report',
     );
       return view('reports.eventreport')->with($data);

      
   }


}
