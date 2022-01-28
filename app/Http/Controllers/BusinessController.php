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

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedcluster = 1, $selectedpathway= 'all', $selectedactivity = 'all')
    {


      if($selectedpathway!='all' && $selectedcluster == 'all'){
          $selectedcluster = pathway::find($selectedpathway)->cluster_id;
        }

      if($selectedcluster == NULL  && $selectedpathway== NULL && $selectedactivity == NULL){
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')->get();
      }else if($selectedcluster != NULL && $selectedcluster != 'all' && $selectedpathway== 'all' && $selectedactivity == 'all'){
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
      }else if($selectedpathway == 'all' && $selectedcluster == 'all' && $selectedactivity != 'all'){
        $businesses =  business::
        whereIn('business.id',business_activity::where('activity_id',$selectedactivity)->pluck('business_id'))
              ->join('business_activities', 'business.id', '=', 'business_activities.business_id')
              ->select( 'business.*')
              ->distinct()
              ->orderBy('business.name', 'asc')
              ->get();
      }
      else{
        $businesses =  business::where('name','like','%')->orderBy('name', 'asc')->get();
        //
      // $businesses =  business::
      // whereIn('business.id',business_pathway::where('pathway_id','like',$selectedpathway=='all'||$selectedpathway==NULL?'%':$selectedpathway)->pluck('business_id'))
      // ->whereIn('business.id',business_activity::where('activity_id', $selectedactivity=='all'||$selectedactivity==NULL?'%':$selectedactivity)->pluck('business_id'))
      //       ->join('business_pathways', 'business.id', '=', 'business_pathways.business_id')
      //       ->select( 'business.*')
      //       ->distinct()
      //       ->orderBy('business.name', 'asc')
      //       ->get();
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
               );
        return view('businessdetail')->with($data);
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
        $internship->position_title = $request->interntitle;
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
             //
             // $clusterid = pathway::find($pathway)->cluster->id;
             //
             // $newpath = new business_pathway;
             // $newpath->business_id = $business->id;
             // $newpath->cluster_id = $clusterid;
             // $newpath->pathway_id = $pathway;
             // $newpath->save();

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
      business::destroy($id);
       return redirect('/');
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

}
