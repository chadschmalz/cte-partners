<div class="modal fade" id="editBizModal" tabindex="-1" aria-labelledby="addBizModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title editBizModalLabel" id="editBizModalLabel">Edit Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/businessupdate'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessEditform' class="businessEditform">
          @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Business Name:</label>
            <input type="hidden" class="form-control bizid" name="bizid" value="" placeholder="name">
            <input type="text" class="form-control bizname" name="bizname" value="" placeholder="name">
            <input type="text" class="form-control mt-1 bizaddress" name="bizaddress" value="" placeholder="street address">
            <input type="text" class="form-control mt-1 bizcity" name="bizcity" value="" placeholder="city">
            <input type="text" class="form-control mt-1 bizstate" name="bizstate" value="" placeholder="state">
            <input type="text" class="form-control smt-1 bizzip" name="bizzip" value="" placeholder="zip">

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
            <textarea class="form-control biznotes" id="message-text" name="biznotes"></textarea>
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
