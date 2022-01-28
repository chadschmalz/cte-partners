@extends('layout.app')

@section('content')

@include('student.add')
@include('student.remove')
@include('student.addinternship')
@include('student.removeInternship')
@include('student.letterEmailModal')


<div class="container-fluid">



@if(session('success'))
<div class="container pt-1 message">
      <div class="alert alert-success">
      {{session('success')}}
      </div>
    </div>
@elseif(session('error'))
    <div class="container pt-1 message">
          <div class="alert alert-danger">
          {{session('error')}}
          </div>
        </div>
@elseif(isset($success))
    <div class="container pt-1 message">
          <div class="alert alert-success">
          {{$success}}
          </div>
        </div>
@elseif(session('info'))
    <div class="container pt-1 message">
          <div class="alert alert-warning">
          {{session('info')}}
          </div>
        </div>

@endif

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class=" col-md-10 col-lg-10">
        <h1 class="h5">Student Detail</h1>
      </div>
        <div class=" col-md-2 col-lg-2 text-end">
        <div class="form-control btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#letterEmailModal">Send Acceptance Email</div>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="row">
              <div class="col-md-4 col-lg-4">
            <div class="h2">{{$student->name}}</div>
          </div>
          <div class="col-md-2 col-lg-2 form-group form-check">
            <label class="form-check-label" for="lettersent">  <input type="checkbox" class="form-check-input" {{$student->lettersent == 'Y'?'checked':''}}>   &nbsp;&nbsp;Letter Sent @if($student->lettersent == 'Y') <br />{{$student->lettersent_at}} @endif</label>
          </div>
          <div class="col-2 form-group form-check">
            <label class="form-check-label" for="lettersent"><form action="/updatestudentresponse" method="get"><input type="hidden" name="id" value="{{$student->id}}"> <input onchange="this.form.submit()" type="checkbox" class="form-check-input"  name="studentresponse" {{$student->studentresponse == 'Y'?'checked':''}}></form> &nbsp;&nbsp;Student Response @if($student->studentresponse == 'Y') <br />{{$student->studentresponse_at}} @endif</label>
          </div>
          <div class=" col-md-2 col-lg-2 text-end">
            @if($student->onboarding == 'Y')<a href="/onboardingComplete/{{$student->id}}"><div class="form-control btn btn-sm btn-success " >Remove from Unassigned</div></a>@endif
          </div>
            <div class=" col-md-1 col-lg-1 text-end">
              <div class="form-control btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#addStudentModal"
              data-bs-action="/studentupdate"
                data-bs-studentid="{{$student->id}}" data-bs-name="{{$student->name}}" data-bs-phone="{{$student->phone}}" data-bs-email="{{$student->email}}" data-bs-locationid="{{$student->location_id}}" data-bs-pathway="{{$student->pathway_id}}"  data-bs-emerg_email="{{$student->emerg_email}}" data-bs-emerg_contact="{{$student->emerg_contact}}" data-bs-notes="{{$student->notes}}"
              >Edit</div>
            </div>

            <div class=" col-md-1 col-lg-1 text-end">
              <div class="form-control btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#studentremoveModal">Remove</div>
            </div>
          </div>
          <div class="row">
             <div class="col-md-10 col-lg-10">
               <h5><u>Pathway</u>: @if($student->pathway != NULL){{$student->pathway->pathway_desc}}@endif</h5>
            </div>

          </div>
            <div class="row">
                      <table class="table table-sm table-striped display" id="BizData" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Student Phone</th>
                                                <th scope="col" >Student Email</th>
                                                <th scope="col" >Parent Name</th>
                                                <th scope="col" >Parent Email</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                               <tr>
                                     <td>{{$student->phone}}</td>
                                     <td>{{$student->email}}</td>
                                     <td>{{$student->emerg_contact}}</td>
                                     <td>{{$student->emerg_email}}</td>

                                  </tr>
                              </tbody>
                          </table>
                          <table class="table table-sm table-striped display" id="BizData" >
                                              <thead>
                                                  <tr>
                                                    <th scope="col" >Lane</th>
                                                    <th scope="col" >Graduation Year</th>
                                                    <th scope="col" >Student School</th>
                                                    <th scope="col" >Career Goal</th>
                                                    <th scope="col" >Semester Preference</th>
                                                    <th scope="col" >Accomodations</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody >
                                   <tr>

                                     <td>{{$student->lane}}</td>
                                     <td>{{$student->grad_year}}</td>
                                     <td>{{$student->school_name}}</td>
                                     <td>{{$student->career_interest}}</td>
                                     <td>{{$student->semester_apply}}</td>
                                     <td>{{$student->accomodations}}</td>

                                      </tr>
                                      <tr>
                                      </tr>
                                  </tbody>
                              </table>
                        </div>
                        <div class="row mt-1">
                          <div class="col-md-4 col-lg-4">
                            <div class="card">
                              <div class="card-header">
                                <div class="row d-flex justify-content-between ">
                                  <div class=" col-md-6 col-lg-6">
                                      <div class="h5">Semesters</div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 ">
                                    <div class=" btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addStudentSemesterModal">Add</div>
                                  </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-6">
                                    Semester
                                  </div>
                                    <div class="col-3">
                                      Seats
                                    </div>
                                    <div class="col-1">
                                    </div>
                                  </div>
                                @foreach($student->semesters as $sem)
                                <div class="row">
                                  <div class="col-6">
                                          {{$sem->semester->semester_desc}}
                                  </div>
                                  <div class="col-3">
                                    {{$sem->seats}}
                                  </div>
                                  <div class="col-1">
                                    <div class=" btn btn-sm btn-danger m-1" data-bs-toggle="modal" data-bs-target="#removeStudentSemesterModal" data-semester="{{$sem->semester->semester_desc}}" data-semesterid="{{$sem->semester->id}}">X</div>
                                    </div>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
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
                                                                 <th scope="col" >SSA</th>
                                                                 <th scope="col" >Action</th>
                                                               </tr>
                                                               </thead>
                                                               <tbody >
                                               @foreach($student->internships as $internship)
                                                <tr>
                                                  <td>{{$internship->semester->semester_desc}}</td>
                                                        <td><a href="/businessdetail/{{$internship->employer->id}}">{{$internship->employer->name}}</td>
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
                                                          <div class="col-md-4 col-lg-4">
                                                            @if($internship->employer->safety_agreement=="Y")
                                                             &#9989;
                                                            @else
                                                             &#10060;
                                                           @endif</div>
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
