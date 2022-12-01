@if(isset($business))
<div class="modal fade" id="letterEmailModal" tabindex="-1" aria-labelledby="letterEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="letterEmailModalLabel">Email Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-4 col-lg-4">
          <div class="h2">{{$business->name}}</div>
        </div>
        </div>
        @foreach($business->pocs as $key=>$poc)
        <div class="row">
          <div class="col-md-6 col-lg-6">
          <form action='/businessemail/{{$business->id}}'  method='post' enctype='multipart/form-data' autocomplete='off' id='businessemailform'>
          @csrf
          <input class="form-check-input " type="checkbox"  name="poc[]" value="{{$poc->id}}" id="poc" @if($poc->mentor == 'Y') checked @endif> <u>POC Name:</u> {{$poc->name}} 
          </div>
          <div class="col-md-6 col-lg-6">
            <u>POC email:</u> {{$poc->email}}
          </div>
        </div>
        @endforeach
        <div class="row">
        

          <div class="row">
            <div class=" col-lg-6 ">
              <label for="recipient-name" class="col-form-label">Email Type:</label>
              <select class="form-select" id="emailtype" name="emailtype" aria-label="Default select example" >

                <option value="acceptance" >L1 Acceptance Letter Email</option>
                <option value="futureacceptance" >Future Student Acceptance Letter Email</option>
                <option value="l2accepted" >L2 Acceptance Letter</option>
                <option value="seatsFull" >Deferral: Employer Seats Full</option>
                <option value="defer" >Deferral: No CTE Course</option>
                <option value="regExpired" >Priority Registration Expired</option>

              </select>
            </div>
           
            </div>
            
            <input type="hidden" name="business_id" value="{{$business->id}}">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </form>
      </div>
    </div>
  </div>
</div>


@endif
