

    <div class="modal fade" id="fyModal" tabindex="-1" role="dialog" aria-labelledby="fyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fyModalLabel">Fiscal Year</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="fyModalMessage"></div>
        <form  id="modalform" >
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Fiscal Year Code:</label>
            <input type="text" class="form-control fycode" id="modalfiscalyear" placeholder="Fiscal Year Code">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Fiscal Year Long Description:</label>
            <input class="form-control fydesc" id="modalfiscalyeardesc" placeholder="Fiscal Year Description">
            <input type="hidden" class="form-control fyid" id="fiscalyearid" value="0">
            <div class="w-100"></div>
            <label for="message-text" class="col-form-label">Fiscal Year Status:</label>
            <select class="form-control fystatus" id="fystatus" name="budget_type">
              <option value="inactive">Inactive</option>
              <option value="active">Active</option>
            </select>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success save" id="submitForm">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
