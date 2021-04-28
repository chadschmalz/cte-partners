

<div class="modal fade" id="pathwayModal" tabindex="-1" aria-labelledby="pathwayModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pathwayModalLabel">Edit Pathways</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/businesspathwayupdate'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessInvolvementUpdateform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <div class="mb-3">
            @if(isset($pathways))
              @foreach($pathways as $pathway)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="pathways[]" value="{{$pathway->id}}" id="pathway{{$pathway->id}}" {{count($business->pathways->where('pathway_id',$pathway->id))>0?'checked':''}}>
                <label class="form-check-label" for="flexCheckDefault">
                  {{$pathway->pathway_desc}}
                </label>
              </div>
              @endforeach
            @endif
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

<div class="modal fade" id="involveModal" tabindex="-1" aria-labelledby="involveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="involveModalLabel">Involvement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/businessinvolvementupdate'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessInvolveUpdateform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Events:</label>
            @if(isset($activitys))
              @foreach($activitys as $activity)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="activitys[]" value="{{$activity->id}}" id="{{$activity->activity_desc}}" {{count($business->activities->where('activity_id',$activity->id))>0?'checked':''}}>
                <label class="form-check-label" for="flexCheckDefault">
                  {{$activity->activity_desc}}
                </label>
              </div>
              @endforeach
            @endif
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
