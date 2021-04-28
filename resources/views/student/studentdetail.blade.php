@extends('layout.app')

@section('content')

@include('student.add')
@include('student.remove')
@include('student.addinternship')
@include('student.removeInternship')


<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Student Detail</h1>
      </div>
      <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="row">
              <div class="col-md-6 col-lg-6">
            <div class="h2">{{$student->name}}</div>
          </div>
          <div class="col-md-3 col-lg-3">

          </div>
            <div class=" col-md-1 col-lg-1 text-end">
              <div class="form-control btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#addStudentModal"
              data-bs-action="/studentupdate"
                data-bs-studentid="{{$student->id}}" data-bs-name="{{$student->name}}" data-bs-phone="{{$student->phone}}" data-bs-email="{{$student->email}}" data-bs-locationid="{{$student->location_id}}" data-bs-pathway="{{$student->pathway_id}}"  data-bs-emerg_phone="{{$student->emerg_phone}}" data-bs-emerg_contact="{{$student->emerg_contact}}" data-bs-notes="{{$student->notes}}"
              >Edit</div>
            </div>
            <div class=" col-md-1 col-lg-1 text-end">
              <div class=" btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#studentremoveModal">Remove</div>
            </div>
          </div>
          <div class="row">
             <div class="col-md-12 col-lg-12">
               <h5><u>Pathway</u>: {{$student->pathway->pathway_desc}}</h5>
            </div>
          </div>
            <div class="row">
                      <table class="table table-sm table-striped display" id="BizData" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Student Phone</th>
                                                <th scope="col" >Student Email</th>
                                                <th scope="col" >Emergency Contact</th>
                                                <th scope="col" >Emergency Phone</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                               <tr>
                                     <td>{{$student->phone}}</td>
                                     <td>{{$student->email}}</td>
                                     <td>{{$student->emerg_contact}}</td>
                                     <td>{{$student->emerg_phone}}</td>

                                  </tr>
                              </tbody>
                          </table>
                        </div>
                          <div class="row mt-2">
                            <div class="col-md-12 col-lg-12">
                              <div class="card">
                                <div class="card-header">
                                  <div class="h5">Notes</div>
                                </div>
                                <div class="card-body">
                                            {{$student->notes}}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-2">
                          <div class=" col-md-12 col-lg-12">
                            <div class="card">
                            <div class="card-header">
                              <div class="row d-flex justify-content-between ">
                                <div class="h6 col-md-8 col-lg-8">
                                    Employer/Internship  Assignment
                                  </div>
                                  <div class="col-md-2 col-lg-2 text-end">
                                  <div class="btn btn-sm btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#InternshipAddModal">Add</div>
                                </div>
                                  </div>
                                </div>
                                    <div class="card-body">
                                      <?php $curCluster = 0;?>
                                      <div class="row">
                                       <table class="table table-sm table-striped display" id="studentDataTable" >
                                                           <thead>
                                                               <tr>
                                                                 <th scope="col" >Semester</th>
                                                                 <th scope="col" >Employer</th>
                                                                 <th scope="col" >Mentor</th>
                                                                 <th scope="col" >Mentor Phone</th>
                                                                 <th scope="col" >Action</th>
                                                               </tr>
                                                               </thead>
                                                               <tbody >
                                               @foreach($student->internships as $internship)
                                                <tr>
                                                  <td>{{$internship->semester->semester_desc}}</td>
                                                        <td>{{$internship->employer->name}}</td>
                                                        <td>
                                                          @if(count($internship->employer->pocs) > 1 && $internship->employer->pocs->where('mentor','Y')!=NULL)
                                                            @foreach($internship->employer->pocs->where('mentor','Y') as $s)
                                                             {{$s->name}}
                                                            @endforeach
                                                            @else
                                                            {{$internship->employer->pocs[0]->name}}
                                                          @endif</td>
                                                        <td> @if(count($internship->employer->pocs) > 1 && $internship->employer->pocs->where('mentor','Y')!=NULL)
                                                           @foreach($internship->employer->pocs->where('mentor','Y') as $s)
                                                            {{$s->phone}}
                                                           @endforeach
                                                           @else
                                                           {{$internship->employer->pocs[0]->phone}}
                                                         @endif
                                                        </td>
                                                      <td>
                                                        <div class=" btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#internshipRemoveModal" data-bs-action="/removeInternship" data-bs-name="{{$student->name}}" data-bs-internshipid="{{$internship->id}}" data-bs-employername="{{$internship->employer->name}}">Remove</div>
                                                       </td>
                                                   </tr>
                                                   @endforeach

                                               </tbody>

                                           </table>
                              </div>
                            </div>
                          </div>
                        </div>

                        </div>
            </div>




          </div>
        </div>
      </div>





</div>


@endsection
