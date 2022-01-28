<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/studentadd'  method='POST' enctype='multipart/form-data' autocomplete='off' id='studentaddform'>
          @csrf
          <div class="mb-3">
          <div class="row">
            <input type="hidden" class="form-control studentid" name="studentid" value="" placeholder="Student Name">

            <div class="col-md-12 col-lg-12">
            <label for="recipient-name" class="col-form-label">Student Name:</label>
            <input type="text" class="form-control stname" name="stname" value="" placeholder="Student Name">
          </div>

          <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">phone:</label>
          <input type="text"  class="form-control stphone" id="stphone" name="stphone" placeholder="Student Phone">
        </div>
        <div class="col-md-6 col-lg-6">
          <label for="recipient-name" class="col-form-label">email:</label>
          <input type="text"  class="form-control stemail" id="stemail" name="stemail" placeholder="Student Email">

      </div>

      <div class="col-md-6 col-lg-6">
        <label for="recipient-name" class="col-form-label">School:</label>
      <select class="form-select " id="stlocation_id" name="stlocation_id" aria-label="Default select example" >
        <option value="" {{!isset($selectedPathway)?'selected':''}}></option>
        @if(isset($locations))
          @foreach($locations as $location)
                  <option value="{{$location->id}}" >{{$location->location_desc}}</option>
          @endforeach
        @endif
      </select>
    </div>
            <div class="col-md-6 col-lg-6">
              <label for="recipient-name" class="col-form-label">Pathway:</label>
            <select class="form-select stpathway" id="stpathway" name="stpathway" aria-label="Default select example" >
              <option value="" ></option>
              @if(isset($pathways))
                @foreach($pathways as $path)
                        <option value="{{$path->id}}" >{{$path->pathway_desc}}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">Emergency Contact:</label>
            <input type="text"  class="form-control stemerg_contact" id="emgname" name="stemgname" placeholder="Emergency Contact Name">

        </div>
        <div class="col-md-6 col-lg-6">
          <label for="recipient-name" class="col-form-label">Emergency Email:</label>
          <input type="text"  class="form-control stemerg_email" id="emgemail" name="stemgemail" placeholder="Emergency Email">

      </div>

          <div class="col-md-12 col-lg-12 employerfield">
            <label for="recipient-name" class="col-form-label">Employer student is placed with:</label>
          <select class="form-control employer_search" name='stemployer' id="erlookupName" >
            <option value=""></option>
          </select>

        </div>
        <div class="col-md-12 col-lg-12 employerfield">
          <label for="recipient-name" class="col-form-label">Semester:</label>
          <select class="form-select" id="semester" name="stsemester" aria-label="Default select example" >
            @if(isset($semesters))
              @foreach($semesters as $sem)
                      <option value="{{$sem->id}}" >{{$sem->semester_desc}}</option>
              @endforeach
            @endif
          </select>
        </div>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Student Notes:</label>
            <textarea class="form-control stnotes" id="message-text" name="stnotes" rows="10"></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
      </div>
    </div>
  </div>
</div>
@if(isset($student))
<div class="modal fade" id="addStudentSemesterModal" tabindex="-1" aria-labelledby="addStudentSemesterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentSemesterModalLabel">Add Semester</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/addsemester'  method='POST' enctype='multipart/form-data' autocomplete='off' id='studentaddsemesterform'>
          @csrf
          <div class="row">
            <div class="col-md-4 col-lg-4 employerfield">
              <label for="recipient-name" class="col-form-label">Semester:</label>
              <select class="form-select" id="semester" name="semester_id" aria-label="Default select example" >
                @if(isset($semesters))
                  @foreach($semesters as $sem)
                          <option value="{{$sem->id}}" >{{$sem->semester_desc}}</option>
                  @endforeach
                @endif
              </select>
            </div>
            <div class="col-2" >
              <label for="recipient-name" class="col-form-label">Seats:</label>
              <input type="input" class="form-control" name="seats" value="2">
            </div>
            <input type="hidden" name="student_id" value="{{$student->id}}">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
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
