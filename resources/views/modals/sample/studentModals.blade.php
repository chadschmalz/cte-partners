<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addBizModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title addStudentModalLabel" id="addStudentModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/studentstore'  method='POST' enctype='multipart/form-data' autocomplete='off' id='studentAddform'>
          @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="bizname" value="" placeholder="Student Name"><br />
            <label for="safety_agreement-name" class="col-form-label"></label>
            <input class="form-check-input ml-2" type="checkbox" name="agreement"  >
            <label class="form-check-label" for="flexCheckDefault">
              Training Agreement
            </label>
          </div>
          <div class="row">

            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Phone:</label>
              <input type="text" class="form-control" name='phone' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control" name='email' value="">
            </div><div class="col-md-4">
            </div>

            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label"> Notes:</label>
              <input type="text" class="form-control" name='notes' value="">
            </div><div class="col-md-4">
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




<div class="modal fade" id="RestoreBizModal" tabindex="-1" aria-labelledby="RestoreBizModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RestoreBizModalLabel">Restore Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="restoreQuestion"></div>
        <div class="mt-2">
        <form action='/businessrestore'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessRestoreform'>
          @csrf
          <input type="hidden" class="restoreBizId" id="restorebizid" name='bizid' value="test">
          <div class="row">
          <div class="col-md-2 col-lg-2 ">
          <button type="submit" class="btn btn-success">Yes</button>
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
