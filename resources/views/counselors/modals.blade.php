<div class="modal fade" id="addCounselorModal" tabindex="-1" aria-labelledby="addCounselorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCounselorModalLabel">Counselor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/counseloradd" id="counselorform" >
          @csrf

            <div class="form-group">
              <label for="message-text" class="col-form-label">Name:</label>
              <input class="form-control name" id="name" name="name" placeholder="Name" required>
              <input type="hidden" class="form-control " id="id" name="id" value="0">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">School:</label>
              <select class="form-select school" id="school" name="school">
                <option value=""></option>
                @foreach($locations as $loc)
                <option value="{{$loc->location}}" >{{$loc->location}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">counselor Assignment:</label>
              <input type="text" class="form-control " id="assignment" name="assignment" placeholder="counselor Assignment" required>

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



<div class="modal fade" id="counselorremoveModal" tabindex="-1" aria-labelledby="counselorremoveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="counselorremoveModalLabel">Remove Counselor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove <strong id="counselorname"></strong>?
        <div class="mt-2">
        <form action=''  method='GET' enctype='multipart/form-data' autocomplete='off' id='counselorDestroyform'>
          @csrf
          <input type="hidden" id='cid' name='id' value="">
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
