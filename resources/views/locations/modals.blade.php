<div class="modal fade" id="addlocationModal" tabindex="-1" aria-labelledby="addlocationModalLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addlocationModalLabel">Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/locationadd" id="locationaddform" >
          @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Location #:</label>
              <input type="text" class="form-control fscode" id="location_num" name="location_num" placeholder="Location Number" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Location Description:</label>
              <input class="form-control location_desc" id="location_desc" name="location_desc" placeholder="location Description" required>
              <input type="hidden" class="form-control " id="location_id" name="location_id" value="0">

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Street:</label>
              <input type="text" class="form-control " id="location_address1" name="location_address1" placeholder="Address" required>

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">City:</label>
              <input type="text" class="form-control " id="location_city" name="location_city" placeholder="City" required>

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">State:</label>
              <input type="text" class="form-control " id="location_state" name="location_state" placeholder="State" required>

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Zip:</label>
              <input type="text" class="form-control " id="location_zip" name="location_zip" placeholder="Zip" required>

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Phone:</label>
              <div class="form-group">
                <input type="text" class="form-control " id="location_phone" name="location_phone" placeholder="Phone" required>

          </div>
            </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success save" id="submitForm">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Location Remove Modal -->
<div class="modal fade" id="removeLocationModal" tabindex="-1" aria-labelledby="removeLocationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeLocationModalLabel">Remove Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body removeLocationBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <div class="removeLocationButton"></div>
      </div>
    </div>
  </div>
</div>
