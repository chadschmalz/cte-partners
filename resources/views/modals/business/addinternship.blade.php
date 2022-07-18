

<div class="modal fade" id="InternshipAddModal" tabindex="-1" aria-labelledby="InternshipAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title InternshipAddModalLabel" id="InternshipAddModalLabel">New Internship: <strong>{{$business->name}}</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/internshipadd'  method='POST' enctype='multipart/form-data' autocomplete='off' id='InternshipAddform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <input type="hidden" class="internid" name='internid' value="">
          <div class="row">
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Pathway:</label>
              <select class="form-select " id="formpathway" name="pathway_id" aria-label="Default select example" >
                @if(isset($pathways))
                  @foreach($pathways as $pathway)
                          <option value="{{$pathway->id}}" >{{$pathway->pathway_desc}}</option>
                  @endforeach
                @endif
              </select>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Minimum Tier:</label>
              <select class="form-select" id="internTier" name="tier" aria-label="Default select example"  >
              <option value=""></option>
              <option value="Tier 1" >Tier 1</option>
              <option value="Tier 2" >Tier 2</option>
                <option value="Tier 3" >Tier 3</option>
              </select>

            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Schedule:</label>
              <select class="form-select" id="entry_point" name="entry_point" aria-label="Default select example"  >
              <option value="">No Preference</option>
              <option value="A-am" >A-am</option>
              <option value="A-pm" >A-pm</option>
              <option value="B-am" >B-am</option>
              <option value="B-pm" >B-pm</option>
<!--
              <option value="Fall Semester" >Fall Semester</option>
              <option value="Spring Semester" >Spring Semester</option>
                <option value="Either" >Either</option> -->
              </select>


            </div><div class="col-md-4">
            </div>
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Internship Length:</label>
              <select class="form-select" id="internlength" name="length" aria-label="Default select example"  >
              <option value=""></option>
              <option value="One Semester" >One Semester</option>
              <option value="Two Semester" >Two Semester</option>
                <option value="No Preference" >No Preference</option>
              </select>
            </div><div class="col-md-4">
            </div>
            <div class="col-md-10">
              <label for="recipient-name" class="col-form-label">How should the intern contact to set up the interview?</label>
              <select class="form-select" id="contactforInterview" name="contact_method" aria-label="Default select example"  >
              <option value=""></option>
              <option value="Email" >Email</option>
              <option value="Phone" >Phone</option>
                <option value="In Person" >In Person</option>
              </select>
            </div><div class="col-md-2">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Notes:</label>
              <textarea class="form-control internnotes" id="internshipnotes" name="internshipnotes"></textarea>
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
