<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\cluster;
use App\Models\pathway;

class PathwayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $businesses =  business::all();
      $data = array(
                 'businesses'=> $businesses,
               );
        return view('business')->with($data);
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
    public function bulkupload(Request $request)
    {
      $path = Storage::putFileAs('uploads', $request->file('upload'),'pathways.csv');
      $contents = file(Storage::path($path));

      foreach($contents as $line) {
        list($clusterDesc, $pathwayDesc) = explode(',',$line);
        if($clusterDesc == 'cluster') continue;

        $myCluster = cluster::where('cluster_desc',$clusterDesc)->get();
        if(count($myCluster)>0){
            //don't create cluster
            $myCluster = $myCluster[0];
        }
        else{
          $myCluster = new cluster;

          $myCluster->cluster_desc = $clusterDesc;
          $myCluster->save();
        }
        $pathway = new pathway;

        $pathway->pathway_desc = $pathwayDesc;
        $pathway->cluster_id = $myCluster->id;
        $pathway->save();
      }
      $curClusters =  cluster::all();

      $data = array(
                 'pathwayCreatedmessage'=> "Pathways Uploaded",
                 'clusters'=> $curClusters,
               );

     return view('utils')->with($data);
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
    public function update(Request $request, $id)
    {
        //
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
