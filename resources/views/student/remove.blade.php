<div class="modal fade" id="studentremoveModal" tabindex="-1" aria-labelledby="studentremoveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentremoveModalLabel">Remove Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove <strong>{{$student->name}}</strong>?
        <div class="mt-2">
        <form action='/removestudent/{{$student->id}}'  method='GET' enctype='multipart/form-data' autocomplete='off' id='studentDestroyform'>
          @csrf
          <input type="hidden" name='studentid' value="{{$student->id}}">
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
