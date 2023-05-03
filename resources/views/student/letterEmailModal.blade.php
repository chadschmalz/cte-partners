@if(isset($student))
<div class="modal fade" id="letterEmailModal" tabindex="-1" aria-labelledby="letterEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="letterEmailModalLabel">Email Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-4 col-lg-4">
          <div class="h2">{{$student->name}}</div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6 col-lg-6">
          Student email: {{$student->email}}
        </div>
        <div class="col-md-6 col-lg-6">
          Parent email:{{$student->emerg_email}}
        </div>
        <form action='/appemail/{{$student->id}}'  method='GET' enctype='multipart/form-data' autocomplete='off' id='studentaddsemesterform'>
          @csrf

          <div class="row">
            <div class=" col-lg-6 ">
              <label for="recipient-name" class="col-form-label">Email Type:</label>
              <select class="form-select" id="emailtype" name="emailtype" aria-label="Default select example" >

                <option value="acceptedinperson" >Accepted In-Person</option>
                <option value="l1onlinews" >L1 Accepted Online</option>
                <option value="l2onlinews" >L2 Accepted Online</option>
                <option value="deferinperson" >Deferral In-Person</option>
                <option value="deferonlinews" >Deferral Online</option>
                <option value="prereqrequired" >Prerequisite Required </option>
                <option value="regexpired" >Priority Registration Expired</option>
                <option value="futuresemester" >Future Semester Registration</option>
              </select>
            </div>
            <div class=" col-lg-6">
              <label for="recipient-name" class="col-form-label">Counselor:</label>
              <select class="form-select" id="counselor" name="counselor_id" aria-label="Default select example" >
                @if(isset($counselors))
                  @foreach($counselors as $c)
                          <option value="{{$c->id}}" >{{$c->name." - ".$c->assignment}}</option>
                  @endforeach
                @endif
              </select>
            </div>
            </div>
            <div class="row ">
              <div class="col-md-1 col-lg-6 ">
              </div>
              <div class="form-check col-4 mt-2 mx-3">
                <input class="form-check-input " type="checkbox"  name="includecounselor" value="Yes" id="includecounselor1">
                <label class="form-check-label" for="includecounselor1">
                  Send copy to Counselor
                </label>
              </div>

          </div>
            <input type="hidden" name="student_id" value="{{$student->id}}">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="removeStudentSemesterModal" tabindex="-1" aria-labelledby="removeStudentSemesterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeStudentSemesterModalLabel">Are you sure you want to remove Semester?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/removesemester'  method='POST' enctype='multipart/form-data' autocomplete='off' id='studentremovesemesterform'>
          @csrf
          <div class="row">
            <div class="semesterDesc"></div>
            <input type="hidden" id="removal_semester_id" name="semester_id" value="">
            <input type="hidden" id="removal_student_id" name="student_id" value="{{$student->id}}">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Remove</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endif
