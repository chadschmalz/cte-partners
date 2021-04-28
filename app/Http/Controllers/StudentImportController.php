<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\CsvData;
use App\Models\location;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentImportController extends Controller
{

    public function getImport()
    {
        return view('student.studentimport.import');
    }

    public function parseImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }
        $csv_header_fields = [];

        if (count($data) > 0) {
            if ($request->has('header')) {
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
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
        foreach ($csv_data as $row) {
          $student = new student();
          foreach (config('app.db_fields') as $index => $field) {
            if($field == 'School'){

              $student->location_id = location::where('location_desc','like','%'.$row[$request->fields[$field]].'%')->first()[0]->id;

            }
              else {
                $student->$field = $row[$request->fields[$field]];
              }
          }
        }
        $student->save();

        return view('student.studentimport.import_success');
    }

}
