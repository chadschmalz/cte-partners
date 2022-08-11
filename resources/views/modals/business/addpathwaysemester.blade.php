<div class="modal fade" id="AddPathwaySemesterModal" tabindex="-1" aria-labelledby="AddPathwaySemesterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddPathwaySemesterModalLabel">Add Pathway</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/addbusinesspathway'  method='POST' enctype='multipart/form-data' autocomplete='off' id="addbizpathwayform">
          @csrf
          <div class="row">
            <div class="col-md-4 col-lg-4 employerfield">
              <label for="recipient-name" class="col-form-label">Pathway:</label>
              <select class="form-select " id="pathwaysel" name="pathway_id" aria-label="Default select example" >
                @if(isset($pathways))
                  @foreach($pathways as $pathway)
                          <option value="{{$pathway->id}}" >{{$pathway->pathway_desc}}</option>
                  @endforeach
                @endif
              </select>
            </div>
            <div class="col-3" >
              <label for="recipient-name" class="col-form-label">Begin Date:</label>
              <input type="input" class="form-control pathwaybegdt" name="begdt" value="{{date('m/d/Y')}}">
            </div>
            <div class="col-3" >
              <label for="recipient-name" class="col-form-label">End Date:</label>
              <input type="input" class="form-control pathwayenddt" name="enddt" value="" required>
            </div>
            <div class="col-2" >
              <label for="recipient-name" class="col-form-label">Seats:</label>
              <input type="input" class="form-control formseats" name="seats" value="2">
            </div>
            <input type="hidden" class="form-control" name="bizid" value="{{$business->id}}">
            <input type="hidden" class="form-control pathwayRecordid" id="pathwayRecordid" name="pathwayRecordid" value="">

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
