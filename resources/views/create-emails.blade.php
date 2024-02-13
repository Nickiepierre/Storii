<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <h5 class="modal-title" id="modalCreateLabel">Add emails</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formModalCreateEmails">
          <div class="col-auto">
            <label for="email" class="form-label">Emails - <small><span class="">For more than one email, separate by commas.(",")</span></small></label>
            <input type="email" class="form-control" id="email" placeholder="Emails">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="createEmails" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        </form>
  </div>
</div>
