<div class="modal fade" id="RestoreBizModal" tabindex="-1" aria-labelledby="RestoreBizModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RestoreBizModalLabel">Restore Partner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="restoreQuestion"></div>
        <div class="mt-2">
        <form action='/businessrestore'  method='POST' enctype='multipart/form-data' autocomplete='off' id='businessRestoreform'>
          @csrf
          <input type="hidden" class="restoreBizId" id="restorebizid" name='bizid' value="test">
          <div class="row">
          <div class="col-md-2 col-lg-2 ">
          <button type="submit" class="btn btn-success">Yes</button>
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
