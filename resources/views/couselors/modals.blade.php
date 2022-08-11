<div class="modal fade" id="addSemesterModal" tabindex="-1" aria-labelledby="addSemesterModalLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSemesterModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/semesteradd" id="semesterform" >
          @csrf

            <div class="form-group">
              <label for="message-text" class="col-form-label">Semester Description:</label>
              <input class="form-control semester_desc" id="semester_desc" name="semester_desc" placeholder="Semester Description" required>
              <input type="hidden" class="form-control " id="semester_id" name="semester_id" value="0">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">School Year:</label>
              <input type="text" class="form-control fscode" id="school_year" name="school_year" placeholder="Semester Year" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Semester End Date:</label>
              <input type="date" class="form-control " id="semester_enddt" name="semester_enddt" placeholder="Semester End Date" required>

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Status:</label>
              <div class="form-group">
            <select class="form-select status" id="semester_status" name="semester_status">
              <option value="active">Active</option>
              <option value="inactive" >Inactive</option>
            </select>

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
