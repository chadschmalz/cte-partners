<div class="modal fade" id="addPOCModal" tabindex="-1" aria-labelledby="addPOCModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title addPOCModalLabel" id="addPOCModalLabel">Add POC for {{$business->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/pocstore' class="businessPOCAddform" method='POST' enctype='multipart/form-data' autocomplete='off' id='POCAddform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <input type="hidden"class="pocid" name='pocid' value="">
          <h5>POC</h5>
          <div class="row">
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control pocname" name='pocname' value="">
            </div>
            <div class="col-md-4">
            </div>

            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control pocemail" name='email' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Phone:</label>
              <input type="text" class="form-control pocphone" name='phone' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">POC Note:</label>
              <input type="text" class="form-control pocnotes" name='notes' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-4">
            <input class="form-check-input mx-2 pocmentor" id="pocmentor" type="checkbox" name="mentor"  >
            <label class="form-check-label" for="flexCheckDefault">
              Intern Mentor
            </label>
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
