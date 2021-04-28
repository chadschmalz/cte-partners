<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\business;
use App\Models\cluster;

class ClusterController extends Controller
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
    public function utils()
    {
      $clusters =  cluster::all();
      $data = array(
                 'clusters'=> $clusters,
               );
      return view('utils')->with($data);

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
      $cluster = new cluster;

      $cluster->cluster_desc = $request->cdesc;

      if($request->note <> NULL)
      $cluster->note = $request->note;

      $cluster->save();

      $curClusters =  cluster::all();

      $data = array(
                 'clusterCreatemessage'=> "Cluster Created",
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
