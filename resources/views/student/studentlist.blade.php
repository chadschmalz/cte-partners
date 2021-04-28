@extends('layout.app')

@section('content')

@include('student.add')

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
            <option value="all" {{ $selectedSemester=='all'?'selected':''}}>All</option>
              @foreach($semesters as $semester)
                      <option value="{{$semester->id}}" {{ $selectedSemester==$semester->id?'selected':''}}>{{$semester->semester_desc}}</option>
              @endforeach

            @endif
          </select>
        </div>
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Location:</label>
          <select class="form-select" id="studentLocation" aria-label="Default select example" onchange=" return refreshStudentList()">
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
      <select class="form-select studentPathway" id="studentPathway" aria-label="Default select example" onchange=" return refreshStudentList()">
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
      <a href="/"><button type="button" class="form-control btn btn-secondary">Reset</button></a>
    </div>
      </div>

      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

                      <div class="databuttons mb-1">
                        Toggle column:
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0"> Student</a>
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column=$selectedSemester>Location</a>
                      					<a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">Pathway</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">Employer</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Semester</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Phone</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">Mentor</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="7">Mentor Phone</a>
                      				</div>

                      <table class="table table-sm table-striped display allBizDataTable" id="allBizDataTable" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Student</th>
                                                <th scope="col" >Location</th>
                                                <th scope="col" >Pathway</th>
                                                @if($selectedSemester == 'all')
                                                <th scope="col" ></th>
                                                @else
                                                <th scope="col" >Employer</th>
                                                <th scope="col" >Semester</th>
                                                <th scope="col" >Mentor</th>
                                                <th scope="col" >Mentor Phone</th>
                                                @endif
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($students))
                               @foreach($students as $student)
                               <tr>
                                 <td><a   href="/studentdetail/{{$student->id}}">{{$student->name}}</a></td>
                                     <td>{{$student->location->location_desc}}</td>
                                     <td>{{$student->pathway->pathway_desc}}</td>
                                     @if(count($student->internships) != 0 && $selectedSemester != 'all')
                                       <td>{{$student->internships->where('semester_id',$selectedSemester)[0]->employer->name}}</td>
                                       <td>{{$student->internships->where('semester_id',$selectedSemester)[0]->semester->semester_desc}}</td>
                                       <td>
                                         @if(count($student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs) > 1 && $student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs->where('mentor','Y')!=NULL)
                                           @foreach($student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs->where('mentor','Y') as $s)
                                            {{$s->name}}
                                           @endforeach
                                           @else
                                           {{$student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs[0]->name}}
                                         @endif</td>
                                       <td> @if(count($student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs) > 1 && $student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs->where('mentor','Y')!=NULL)
                                          @foreach($student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs->where('mentor','Y') as $s)
                                           {{$s->phone}}
                                          @endforeach
                                          @else
                                          {{$student->internships->where('semester_id',$selectedSemester)[0]->employer->pocs[0]->phone}}
                                        @endif
                                       </td>
                                       @elseif($selectedSemester == 'all')
                                       <td >
                                         <table width="100%">
                                           <tr>
                                             <th scope="col" >Employer</th>
                                             <th scope="col" >Semester</th>
                                             <th scope="col" >Mentor</th>
                                             <th scope="col" >Mentor Phone</th>
                                           </tr>
                                           @foreach($student->internships as $s)

                                         <tr>
                                                 <td>{{$s->employer->name}}</td>
                                                 <td>{{$s->semester->semester_desc}}</td>
                                                 <td>
                                                   @if(count($s->employer->pocs) > 1 && $s->employer->pocs->where('mentor','Y')!=NULL)
                                                     @foreach($s->employer->pocs->where('mentor','Y') as $s1)
                                                      {{$s1->name}}
                                                     @endforeach
                                                     @else
                                                     {{$s->employer->pocs[0]->name}}
                                                   @endif</td>
                                                 <td> @if(count($s->employer->pocs) > 1 && $s->employer->pocs->where('mentor','Y')!=NULL)
                                                    @foreach($s->employer->pocs->where('mentor','Y') as $s2)
                                                     {{$s2->phone}}
                                                     @endforeach
                                                    @else
                                                    {{$s->employer->pocs[0]->phone}}
                                                  @endif
                                                 </td>


                                            </tr>
                                            @endforeach

                                          </table>
                                       </td>
                                       @else
                                     <td></td>
                                     <td></td>
                                     <td></td>
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
