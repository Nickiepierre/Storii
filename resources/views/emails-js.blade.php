<?php
	header("Content-Type: text/javascript; charset=utf-8");
  ?>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script type="text/javascript" language="javascript" src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js



"></script>
<script>
  $(document).ready(function() {
    datatableEmails.init();
    $("#createEmails").click(function sendEmails(e) {
		e.preventDefault();
		var b = $(this), f = $("#formModalCreateEmails");
    console.log(f);
		b.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0) &&
		f.ajaxSubmit({
			url: "{{ route('create-emails') }}",
     		type: 'POST',
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				emails: $('#email').val()
			},
			success: function(d) {
				console.log(d.data);
					toastr["success"](d.msg);
					swal({
						title: d.msg,
						icon: "success",
						confirmButtonClass: "btn btn-success m-btn m-btn--wide m-btn--icon",
						button: "OK",
					}).then(function(e) {
            b.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1);
            $('#modalCreate').modal('hide');
            datatableEmails.init();
					});
			},
			error: function(d) {
				toastr["error"]("La información no se ha logrado enviar, intentelo nuevamente.");
				swal({
					title: "ERROR",
					icon: "error",
					confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
				}).then(function(e) {
					b.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1);
					//window.location.replace("/login");
				});
			},
		});
	});
  });
  var datatableEmails = {
  	init: function() {
    	var t;
    	t = $("#datatableEmails").DataTable({
					 	responsive: !1,
					 	//searchDelay: 500,
					 	processing: !0,
					 	serverSide: !0,
					 	searching: !1,
					 	paging: !1,
					 	info:	!1,
						destroy : !0,
						autoWidth: !1,
					 	ajax: {
					 		url: "{{ route('emails-get') }}",
					 		method: "post",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
					 	},
					 	columnDefs: [
					 			{ targets: [0], orderable: false},
					 			{ targets: [0]},
								{ targets: [0,1,2]},
					 	],
					});
   }
 }
</script>