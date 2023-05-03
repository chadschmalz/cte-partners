<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\conesite;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('locations.index')->with([
        'locations'=>location::all(),
        'conesites'=>conesite::all(),
      ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new location;

        $location->location_num = $request->location_num;
        $location->location_desc = $request->desc;
        $location->address1 = $request->address1;
        $location->city = $request->city;
        $location->state = $request->state;
        $location->zip = $request->zip;
        $location->phone = $request->phone;
        $location->conesite = $request->conesite;
        $location->save();
        // $location->school_year = $request->school_year;
        return redirect('/locations');
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
      if($request->location_status)
        {
          foreach (location::where('status','active')->get() as $key => $value) {
            $value->status = 'inactive';
            $value->save();
          }
        }

      $location = location::find($request->id);

      $location->location_num = $request->location_num;
      $location->location_desc = $request->desc;
      $location->address1 = $request->address1;
      $location->city = $request->city;
      $location->state = $request->state;
      $location->zip = $request->zip;
      $location->phone = $request->phone;
        $location->conesite_id = $request->conesite;
        $location->save();
      // $location->school_year = $request->school_year;
      return redirect('/locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      location::destroy($id);
      return redirect('/locations')->with([
        'error'=>'Location '.$id.' Removed'
      ]);

    }


        public function getImport()
        {
            return view('locations.locationimport.import');
        }



        public function processImport(Request $request)
        {

          $path = $request->file('csv_file')->getRealPath();

          $data = array_map('str_getcsv', file($path));

          foreach ($data as $rowindex => $row) {
              if($request->has('header') and $rowindex == 0)
                continue;

              $location = new location();


              $location->location_num = $row[0];
              $location->location_desc = $row[1];
              $location->address1 = $row[2];
              $location->city = $row[3];
              $location->state = $row[4];
              $location->zip = $row[5];
              $location->phone = $row[6];

              $location->save();

              return redirect('/locations');
        }
      }
}
