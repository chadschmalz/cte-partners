

<div class="modal fade" id="InternshipAddModal" tabindex="-1" aria-labelledby="InternshipAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title InternshipAddModalLabel" id="InternshipAddModalLabel">New Assignment for: <strong>{{$student->name}}</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/studentinternshipadd'  method='POST' enctype='multipart/form-data' autocomplete='off' id='InternshipAddform'>
          @csrf
          <input type="hidden" name='studentid' value="{{$student->id}}">
          <div class="row">
            <div class="col-md-12 col-lg-12 ">
              <label for="recipient-name" class="col-form-label">Employer student is placed with:</label>
            <select class="form-control employer_search2" name='stemployer' id="InternERlookup" width="100%">
            </select>

          </div>
          <div class="col-md-12 col-lg-12 ">
            <label for="recipient-name" class="col-form-label">Semester:</label>
            <select class="form-select" id="InternSemester" name="stsemester" aria-label="Default select example" >
              @if(isset($semesters))
                @foreach($semesters as $sem)
                        <option value="{{$sem->id}}" >{{$sem->semester_desc}}</option>
                @endforeach
              @endif
            </select>
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
