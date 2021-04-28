<div class="modal fade" id="bizeditModal" tabindex="-1" aria-labelledby="bizeditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bizeditModalLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/businessupdate'  method='POST' enctype='multipart/form-data' autocomplete='off' id='pocUpdateform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Business Name:</label>
            <input type="text" class="form-control" name="bizname" value="{{$business->name}}"><br />
            <label for="safety_agreement-name" class="col-form-label"></label>
            <input class="form-check-input ml-2" type="checkbox" name="agreement"  {{$business->safety_agreement == 'Y'?'checked':''}}>
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
            <textarea class="form-control" id="biznotes" name="biznotes">{{$business->notes}}</textarea>
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





<div class="modal fade" id="InternshipAddModal" tabindex="-1" aria-labelledby="InternshipAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InternshipAddModalLabel">New Internship: <strong>{{$business->name}}</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/internshipadd'  method='POST' enctype='multipart/form-data' autocomplete='off' id='InternshipAddform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <div class="row">
            <div class="col-md-8">
              <label for="recipient-name" class="col-form-label">Position Title:</label>
              <input type="text" class="form-control" name='title' value="" placeholder="Description">
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
              <label for="recipient-name" class="col-form-label">Entry Point:</label>
              <select class="form-select" id="entry_point" name="entry_point" aria-label="Default select example"  >
              <option value=""></option>
              <option value="Fall Semester" >Fall Semester</option>
              <option value="Spring Semester" >Spring Semester</option>
                <option value="Either" >Either</option>
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
              <option value="Two Semester" >Phone</option>
                <option value="No Preference" >In Person</option>
              </select>
            </div><div class="col-md-2">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Notes:</label>
              <textarea class="form-control" id="internshipnotes" name="notes"></textarea>
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


<div class="modal fade" id="pathwayModal" tabindex="-1" aria-labelledby="pathwayModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pathwayModalLabel">Edit Pathways</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/businesspathwayupdate'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessPathUpdateform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <div class="mb-3">
            @if(isset($pathways))
              @foreach($pathways as $pathway)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="pathways[]" value="{{$pathway->id}}" id="{{$pathway->pathway_desc}}" {{count($business->pathways->where('pathway_id',$pathway->id))>0?'checked':''}}>
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




<div class="modal fade" id="bizremoveModal" tabindex="-1" aria-labelledby="bizremoveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bizremoveModalLabel">Remove Partner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove <strong>{{$business->name}}</strong>?
        <div class="mt-2">
        <form action='/businessdestroy/{{$business->id}}'  method='GET' enctype='multipart/form-data' autocomplete='off' id='businessDestroyform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <div class="row">
          <div class="col-md-2 col-lg-2 ">
          <button type="submit" class="btn btn-danger">Yes</button>
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



<div class="modal fade" id="addPOCModal" tabindex="-1" aria-labelledby="addPOCModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title addPOCModalLabel" id="addPOCModalLabel">Add POC for {{$business->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='/pocstore' class="businessPOCAddform" method='POST' enctype='multipart/form-data' autocomplete='off' id='businessPOCAddform'>
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
            <input class="form-check-input mx-2 pocmentor" type="checkbox" name="mentor"  >
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

<div class="modal fade" id="POCremoveModal" tabindex="-1" aria-labelledby="POCremoveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="POCremoveModalLabel">Remove POC</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="pocremoveQuestion">Remove?</div>

        <div class="mt-2">
        <form action='/pocdestroy'  method='POST' enctype='multipart/form-data' autocomplete='off' id='pocDestroyform'>
          @csrf
          <input type="hidden" name='bizid' value="{{$business->id}}">
          <input class="pocremovePOCId" type="hidden" name='pocid' value="">
          <div class="row">
          <div class="col-md-2 col-lg-2 ">
          <button type="submit" class="btn btn-danger">Yes</button>
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
