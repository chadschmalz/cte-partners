<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\business;
use App\Models\poc;

class POCController extends Controller
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
      $poc = new poc;

      $poc->business_id = $request->bizid;
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

      return redirect('/businessdetail/'.$request->bizid);
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
      $poc = poc::find($request->pocid);

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

      return redirect('/businessdetail/'.$request->bizid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        poc::destroy($request->pocid);
        return redirect('/businessdetail/'.$request->bizid);

    }
}
