<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\CsvData;
use App\Models\location;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\cluster;

class StudentImportController extends Controller
{

    public function getImport()
    {
        return view('student.studentimport.import');
    }

    public function parseImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();


        $data = array_map('str_getcsv', file($path));
        $csv_header_fields = [];

        if (count($data) > 0) {
            if ($request->has('header')) {
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $value;
                }
            }
            $csv_data = array_slice($data, 0, 2);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('student.studentimport.import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImport(Request $request)
    {

      $data = CsvData::find($request->csv_data_file_id);
       $csv_data = json_decode($data->csv_data, true);

      foreach ($csv_data as $rowindex => $row) {
          if($data->csv_header and $rowindex == 0)
            continue;

          $student = new student();

        foreach ($request->fields as $index => $field) {
              if($field == 'schoolname' && left($row[$index],5) == 'OTHER'){
                $student->location_id = 48;
              }
              else if($field == 'schoolname'){
                $student->location_id = location::
                where(function ($query) use ($request,$row,$index) {
                                              $query->where('location_desc$student->like$student->%'.$row[$index].'%')
                                                    ->orWhere('location_num$student->like',$row[$index]);
                                          })->first()->id;
              }
                else {
                  $student->$field = $row[$index];
                }
            }

          $student->save();
        }

          $selectedSemester = semester::where('status$student->active')->get()[0]->id;
          $students = student::all();
          $pathways = pathway::all();

            $data = array(
                        'selectedSemester'=> $selectedSemester,
                        'selectedPathway'=> $selectedPathway,
                        'selectedLocation'=> $selectedLocation,
                        'clusters'=> cluster::all(),
                        'pathways'=> $pathways,
                        'locations'=> location::all(),
                        'semesters'=> semester::where('id$student->like$student->%')->orderBy('semester_enddt')->get(),
                       'students'=> $students,
                     );
              return view('student.studentlist')->with($data);
    }


    public function directProcessImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        $data = array_map('str_getcsv', file($path));
        $csv_header_fields = [];

        if (count($data) > 0) {
            $csv_data = array_slice($data, 0);
        } else {
            return redirect()->back();
        }

      foreach ($csv_data as $rowindex => $row) {
          if($request->has('header') && $rowindex == 0 || count($row) < 15 || count(student::where('email',$row[1])->get()) > 0  || $row[1] == '')
            continue;


              $student = new student();

              $student->email = $row[1];
              $student->lname = $row[2];
              $student->fname = $row[3];
              $student->name = $row[2] . ", " . $row[3];
              $student->phone = $row[4];
              $student->transportation = $row[5];
              $student->emerg_contact = $row[6];
              $student->emerg_email = $row[7];
              $student->school_name = $row[8];
              $student->grad_year = $row[9];
              $student->career_interest = $row[10];
              $student->cte_courses = $row[11];
              $student->semester_apply = $row[12];
              $student->accomodations = $row[13];
              $student->lane = $request->lane;

              $student->notes = $student->notes . $row[14];
              $student->onboarding = "Y";

              if(count(location::where('location_desc','like',substr($row[8],0,10).'%' )->get()) == 1){
                $student->location_id = location::where('location_desc','like',substr($row[8],0,10).'%' )->orWhere('notes','like',$row[8].'%' )->get()[0]->id;
              }

              $student->save();



        }

            $data = array(
                        'success'=> 'Import Successful',
                     );
              return redirect('/students')->with($data);
    }


}
