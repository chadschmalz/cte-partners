@extends('layout.app')

@section('content')


<div class="container-fluid">
        <div class="row p-3">
          <div class="col-md-3">
            <h1 class="h2">Pathway Seats </h1>
          </div>
          <div class="col-3">
            <label for="recipient-name" class="col-form-label">Semester:</label>
 <select class="form-select" id="semester"  onchange=" return refreshPathwaySeatList()">
          <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
          @if(isset($semesters))
            @foreach($semesters as $semester)
              <option value="{{$semester->id}}" {{ $activesemester==$semester->id  ?'selected':''}}>{{$semester->semester_desc}}</option>
            @endforeach
          @endif
        </select>
      </div>
      <div class="col-4 ">

      </div>
      <div class="col-2 ">

        <!-- Location Remove Modal -->
        <div class="modal fade" id="copySeatsModal" tabindex="-1" aria-labelledby="copySeatsModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="copySeatsModalLabel">Copy to Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body ">

                              <form method="post" action="/copypathwayseats" id="copyseatsform" >
                                @csrf

                <div class="row p-3">
                  <div class="col">
                    <label for="recipient-name" class="col-form-label">From Semester:</label>
         <select class="form-select" id="fromsemester" name="fromsemester" >
                  <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
                  @if(isset($semesters))
                    @foreach($semesters as $semester)
                      <option value="{{$semester->id}}" {{ $activesemester==$semester->id  ?'selected':''}}>{{$semester->semester_desc}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="col">
                <label for="recipient-name" class="col-form-label">To Semester:</label>
     <select class="form-select" id="tosemester" name="tosemester">
              <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
              @if(isset($semesters))
                @foreach($semesters as $semester)
                  <option value="{{$semester->id}}" {{ $activesemester+1==$semester->id  ?'selected':''}}>{{$semester->semester_desc}}</option>
                @endforeach
              @endif
            </select>
          </div>
            </div>


              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Copy</button>
              </form>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>
        <label for="recipient-name" class="col-form-label">&nbsp;</label>
        <div class="form-control  btn btn-success" data-bs-toggle="modal" data-bs-target="#copySeatsModal">Copy to Semester</div>
      </div>
    </div>

<hr>
<div class="row ">

<div class="col-md-3 col-lg-3">
</div>

      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <form method="post" action="/updatepathwayseats" id="updateseatsform" >
                @csrf<input type="hidden" name="activesemester" value="{{$activesemester}}">

                      <table class="table table-sm table-striped "  id="" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Pathway Desc</th>
                                                <th scope="col" >Seats</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(count($pathwayseats) > 0)
                               @foreach($pathwayseats as $pathwayseat)
                               <tr>
                                 <td>{{$pathwayseat->pathway->pathway_desc}}</td>
                                 <td><input type="hidden" name="ids[]" value="{{$pathwayseat->id}}">
                                   <input type="text" name="seats[]" value="{{$pathwayseat->seats}}"></td>

                                  </tr>
                               @endforeach
                             @endif

                              </tbody>
                          </table>

                          <button class="col-3  btn btn-success" >Save Changes</button>
                        </form>



            </div>
        </div>
      </div>
    </div>

      <div class="col-md-3 col-lg-3">
      </div>
</div>



@endsection
