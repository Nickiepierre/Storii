
<!DOCTYPE html>
<html>
<header>
  @include('emails-sent-js')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" ></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>Emails Sent</title>
</header>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Welcome</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="emails">Emails</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('emails-sent')}}">Sent Emails</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div>
    <div class="input-group-append">
      Emails sent count 
  	  <button class="btn btn-success" type="button" data-bs-toggle="modal" href="#modalSending" id="newSend"><i class="bi bi-bookmark-plus-fill"></i></button>
    </div>
    <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
      <table id="datatableEmailsSents" class="center table table-success table-striped table-bordered m-datatable__table dt-responsive" style="width:100%">
        <thead class="m-datatable__head">
          <tr class="m-datatable__row">
            <th class="m-datatable__cell">Filename</th>
            <th class="m-datatable__cell">Number of emails</th>
            <th class="m-datatable__cell">Date</th>
          </tr>
        </thead>
        <tbody class="m-datatable__body">
          {{-- Datos del Datatable --}}
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
    
    @include('send-emails')
</body>
</html>