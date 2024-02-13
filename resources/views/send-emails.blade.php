<div class="modal fade" id="modalSending" tabindex="-1" role="dialog" aria-labelledby="modalSendingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <h5 class="modal-title" id="modalSendingLabel">Send emails</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formModalEmailsSend">
          <div class="col-auto">
            <label for="tittle" class="form-label">Tittle - <small><span class="">Default("Mail from a Storii test")</span></small></label>
            <input type="email" class="form-control" id="tittle" placeholder="Tittle">
          </div>
          <div class="col-auto">
            <label for="body" class="form-label">Body - <small><span class="">Default("This is for testing email for Storii.")</span></small></label>
            <input type="textarea" class="form-control" id="body" placeholder="Body">
          </div>
          <div class="col-auto">
            <label for="formFileSm" class="form-label">Attachment</label>
            <input class="form-control form-control-sm" id="attatchment" type="file">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="sendEmails" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        </form>
  </div>
</div>
