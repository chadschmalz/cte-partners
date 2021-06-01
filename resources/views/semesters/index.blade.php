@extends('layout.app')

@section('content')

@include('semesters.modals')

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Semesters</h1>

      </div>




      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row pb-2">
              <div class="col-2 btn btn-success">Add Semester</div>
            </div>
            <div class="row">



                      <table class="table table-sm table-striped "  id="" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Semester</th>
                                                <th scope="col" >Semester Desc</th>
                                                <th scope="col" >Status</th>
                                                <th scope="col" >Action</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($semesters))
                               @foreach($semesters as $semester)
                               <tr>
                                 <td><a   href="#">{{$semester->school_year}}</a></td>
                                     <td>{{$semester->semester_desc}}</td>
                                     <td>{{$semester->status}}</td>
                                     <td>              <div class="col-2 btn btn-primary">Edit</div></td>

                                  </tr>
                               @endforeach
                             @endif

                              </tbody>

                          </table>






            </div>
          </div>
        </div>
      </div>

</div>


@endsection
