<div class="modal fade" id="addBizModal" tabindex="-1" aria-labelledby="addBizModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBizModalLabel">Add Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/businessstore'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessEditform'>
          @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Business Name:</label>
            <input type="text" class="form-control " name="bizname" value="" placeholder="name">
            <input type="text" class="form-control mt-1" name="bizaddress" value="" placeholder="street address">
            <input type="text" class="form-control mt-1" name="bizcity" value="" placeholder="city">
            <input type="text" class="form-control mt-1" name="bizstate" value="" placeholder="state">
            <input type="text" class="form-control smt-1" name="bizzip" value="" placeholder="zip">

            <label for="safety_agreement-name" class="col-form-label"></label>
            <input class="form-check-input ml-2" type="checkbox" name="agreement"  >
            <label class="form-check-label" for="flexCheckDefault">
              Safety Agreement
            </label>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Next Internship Availability:</label>
              <select class="form-select" id="next_internshipSelect" name="next_internship" aria-label="next_internshipSelect"  >
              <option value=""></option>
              <option value="Beginning in January" >Beginning in January</option>
              <option value="Beginning in August" >Beginning in August</option>
              <option value="On the fence" >On the fence</option>
                <option value="No Thanks" >No Thanks</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Employer Notes:</label>
            <textarea class="form-control" id="message-text" name="biznotes"></textarea>
          </div>
          <hr>
          <h5>POC</h5>
          <div class="row">
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name='pocname' value="">
            </div>
            <div class="col-md-4">
            </div>

            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control" name='email' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Phone:</label>
              <input type="text" class="form-control" name='phone' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">POC Note:</label>
              <input type="text" class="form-control" name='notes' value="">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-4">
            <input class="form-check-input mx-2" type="checkbox" name="mentor"  >
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



<div class="modal fade" id="RestoreBizModal" tabindex="-1" aria-labelledby="RestoreBizModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RestoreBizModalLabel">Restore Partner</h5>
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
