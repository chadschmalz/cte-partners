@extends('layout.app')

@section('content')

@include('student.add')
<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">ERROR UPDATING</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <div class="errorbody alert alert-danger">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Students</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <ul class="nav nav-pills">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle btn btn-outline-secondary " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Links</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>


      <div class="row mb-3">
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Semester:</label>
          <select class="form-select" id="studentSemester" aria-label="Default select example" onchange=" return refreshStudentList()">
            @if(isset($semesters))
            <option value="dropped">Dropped</option>
            <option value="unassigned" {{ $selectedSemester=='unassigned'?'selected':''}}>Unassigned</option>
            <option value="all" {{ $selectedSemester=='all'?'selected':''}}>All</option>
              @foreach($semesters as $semester)
                      <option value="{{$semester->id}}" {{ $selectedSemester==$semester->id?'selected':''}}>{{ $semester->status=="active"  ?'Current: ':''}}{{$semester->semester_desc}}</option>
              @endforeach

            @endif
          </select>
        </div>
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Location:</label>
          <select class="form-select" id="studentLocation" aria-label="Default select example" onchange="return refreshStudentList()">
            @if(isset($locations))
            <option value="all" {{ $selectedLocation=='all'?'selected':''}}>All</option>
              @foreach($locations as $location)
                      <option value="{{$location->id}}" {{ $selectedLocation==$location->id?'selected':''}}>{{$location->location_desc}}</option>
              @endforeach

            @endif
          </select>
        </div>

      <div class="col-md-3 col-lg-3">
        <label for="recipient-name" class="col-form-label">Pathway:</label>
      <select class="form-select studentPathway" id="studentPathway" aria-label="Default select example" onchange="return refreshStudentList()">
        <option value="all" {{ $selectedPathway==NULL  ?'selected':''}}>All</option>
        @if(isset($pathways))
          @foreach($pathways as $path)
                  <option value="{{$path->id}}" {{ $selectedPathway==$path->id?'selected':''}}>{{$path->pathway_desc}}</option>
          @endforeach
        @endif
      </select>
    </div>

    <div class="col-md-1 col-lg-1">
      <label for="recipient-name" class="col-form-label">&nbsp;</label>
      <a href="/students"><button type="button" class="form-control btn btn-secondary">Reset</button></a>
    </div>
      </div>

      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <div class="databuttons mb-1">
               Toggle column:


               <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0" style="text-align:center">Name</a>
                 <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1" style="text-align:center">email</a>
               <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2" style="text-align:center">phone</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">Location</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Pathway</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Employer</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">EmployerAddress</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="7">Semester</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="8">Mentor</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="9">Mentor Phone</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="10">LetterSent</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="11" style="text-align:center">LA</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="12" style="text-align:center">WS1</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="13" style="text-align:center">WS2</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="14" style="text-align:center">RESUME</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="15" style="text-align:center">MOCK</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="16" style="text-align:center">TA</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="20">Schedule</a>
                                       </div>


                      <table class="table table-sm table-striped display allStudentDataTable" id="allStudentDataTable" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Student</th>
                                                <th scope="col" style="text-align:center">email</th>
                                                <th scope="col" style="text-align:center">phone</th>
                                                <th scope="col" >Location</th>
                                                <th scope="col" >Pathway</th>
                                                <th scope="col" >Employer</th>
                                                <th scope="col" >EmployerAddress</th>
                                                <th scope="col" >Semester</th>
                                                <th scope="col" >Mentor</th>
                                                <th scope="col" >Mentor Phone</th>
                                                <th scope="col" >LetterSent</th>
                                                <th scope="col" style="text-align:center">LA</th>
                                                <th scope="col" style="text-align:center">WS1</th>
                                                <th scope="col" style="text-align:center">WS2</th>
                                                <th scope="col" style="text-align:center">RESUME</th>
                                                <th scope="col"style="text-align:center" >MOCK</th>
                                                <th scope="col" style="text-align:center">TA</th>
                                                <th scope="col" style="text-align:center">RESUME Data</th>
                                                <th scope="col"style="text-align:center" >MOCK Data</th>
                                                <th scope="col" style="text-align:center">TA Data</th>
                                                <th scope="col" >Schedule</th>

                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($students))
                               @foreach($students as $student)
                               <tr>
                                 <td><a   href="/studentdetail/{{$student->id}}" target="_blank">{{$student->name}}</a></td>

                                 <td>{{$student->email}}</td>
                                 <td>{{$student->phone}}</td>
                                     <td>@if($student->location_id != NULL){{$student->location->location_desc}}@else  {{$student->school_name }}  @endif</td>
                                     @if(count($student->semesters->where('semester_id',$selectedSemester)) > 0 )
                                     <td>@foreach($student->semesters->where('semester_id',$selectedSemester) as $sem) {{$sem->pathway->pathway_desc}} @endforeach</td>
                                     @else
                                     <td>@foreach($student->semesters as $sem) {{$sem->pathway->pathway_desc}}, @endforeach</td>
                                     @endif
                                    @if(count($student->internships->where('semester_id',$selectedSemester)) > 0 && $selectedSemester != 'all')


                                     @foreach($student->internships->where('semester_id',$selectedSemester) as $internship)
                                     <td>{{$internship->employer->name}}</td>
                                       <td>{{$internship->employer->address}}, {{$internship->employer->city}}, {{$internship->employer->state}} {{$internship->employer->zip}}</td>
                                       <td>{{$internship->semester->semester_desc}}</td>

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
                                       @endforeach

                                       @elseif(count($student->internships->where('semester_id',$selectedSemester)) == 0 && $selectedSemester == 'all')
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       @elseif(count($student->internships->where('semester_id',$selectedSemester)) == 0 && $selectedSemester != 'all')
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    @endif
                                     <td>@if($student->lettersent_at != NULL){{date('m/d/Y',strtotime($student->lettersent_at))}}@endif</td>
                                     <td style="text-align:center"><input class="updateTracking " id="la{{$student->id}}" type="checkbox" class="form-check-input"  data-studentid="{{$student->id}}" {{$student->la == 'Y'?'checked':''}}></td>
                                     <td>{{$student->ws1}}</td>
                                     <td>{{$student->ws2}}</td>
                                     <td style="text-align:center"><input class="updateTracking " id="resume{{$student->id}}" type="checkbox" class="form-check-input"  data-studentid="{{$student->id}}" {{$student->resume == 'Y'?'checked':''}}></td>
                                     <td style="text-align:center"><input class="updateTracking " id="mock{{$student->id}}" type="checkbox" class="form-check-input"  data-studentid="{{$student->id}}" {{$student->mock == 'Y'?'checked':''}}></td>
                                     <td style="text-align:center"><input class="updateTracking " id="ta{{$student->id}}" data-studentid="{{$student->id}}" type="checkbox" class="form-check-input"  {{$student->ta == 'Y'?'checked':''}}></td>
                                     <td>{{$student->resume}}</td>
                                     <td>{{$student->mock}}</td>
                                     <td>{{$student->ta}}</td>
                                     @if(count($student->semesters->where('semester_id',$selectedSemester)) > 0 )
                                     <td>@foreach($student->semesters->where('semester_id',$selectedSemester) as $sem) {{$sem->schedule}} @endforeach</td>
                                     @else
                                     <td></td>
                                     @endif
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
