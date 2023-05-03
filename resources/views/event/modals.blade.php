  <div class="modal fade" id="EventModal" tabindex="-1" aria-labelledby="EventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="EventModalLabel">Event</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form action='/eventadd'  method='POST' enctype='multipart/form-data' autocomplete='off' id='eventform'>
        @csrf
        <div class="mb-3">
        <div class="row">

          <div class="col-md-6 col-lg-6">
          <label for="recipient-name" class="col-form-label">Event Desc:</label>
          <input type="text" class="form-control event_desc" name="event_desc" value="" placeholder="Description" required>
        </div>
        <div class="col-md-6 col-lg-6">
        <label for="recipient-name" class="col-form-label">Event Date:</label>
        <input type="date" class="form-control event_dt" name="event_dt" value="{{date('Y-m-d')}}" >
      </div>

        <div class="col-md-6 col-lg-6">
          <label for="recipient-name" class="col-form-label">Activity:</label>
        <select class="form-select activity_id" id="activity_id" name="activity_id" aria-label="Default select example" required>
            <option value="" ></option>
            @if(isset($activities))
              @foreach($activities as $act)
                      <option value="{{$act->id}}" >{{$act->activity_desc}}</option>
              @endforeach
            @endif
          </select>
      </div>
      <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">Pathway:</label>
          <select class="form-select pathway_id" id="pathway_id" name="pathway_id" aria-label="Default select example" required>
            <option value="" ></option>
            @if(isset($pathways))
              @foreach($pathways as $path)
                      <option value="{{$path->id}}" >{{$path->pathway_desc}}</option>
              @endforeach
            @endif
          </select>
        </div>

    <div class="col-md-6 col-lg-6">
      <label for="recipient-name" class="col-form-label">School:</label>
    <select class="form-select location_id" id="location_id" name="location_id" aria-label="Default select example" required>
      <option value="" {{!isset($selectedPathway)?'selected':''}}></option>
      @if(isset($locations))
        @foreach($locations as $location)
                <option value="{{$location->id}}" >{{$location->location_desc}}</option>
        @endforeach
      @endif
    </select>
  </div>
          
  <div class="col-md-6 col-lg-6 ">
            <label for="recipient-name" class="col-form-label">Employer:</label>
          <select class="employer_search2" name='business_id' id="InternERlookup" required>
          </select>
        </div>
        </div>
        <div class="mb-3">
          <label for="message-text" class="col-form-label">Notes:</label>
          <textarea class="form-control notes" id="message-text" name="notes" rows="10"></textarea>
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

