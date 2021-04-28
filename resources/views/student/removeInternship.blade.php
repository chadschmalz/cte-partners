<div class="modal fade" id="internshipRemoveModal" tabindex="-1" aria-labelledby="bizremoveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bizremoveModalLabel">Remove Internship</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mt-2 internshipremovequestion">
          Are you sure you want to remove internship from <strong>{{$student->name}}</strong>?
        </div>
        <div class="mt-2">
        <form action='/removeInternship'  method='Post' enctype='multipart/form-data' autocomplete='off' id='internshipDestroyform'>
          @csrf
          <input type="hidden" class="studentid" name='studentid' value="{{$student->id}}">
          <input type="hidden" class="internshipid" name='internshipid' value="">
          <div class="row">
          <div class="col-md-2 col-lg-2 ">
          <button type="submit" class="btn btn-danger">Yes</button>
        </div>
        <div class="col-md-8 col-lg-8 ">
        </div>
          <div class="col-md-2 col-lg-2 text-end">
          <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">No</button>
        </div>
      </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
