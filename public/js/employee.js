$(document).ready(function () {
	generateDatatables()
})

function generateDatatables()
{
	$('#employee_table').DataTable({
		// responsive: true,
		processing: true,
		serverSide: true,
		bDestroy: true,
		ordering: false,
		ajax: $('#employee_table').data('table-route'),
		lengthMenu: [5, 10, 25, 50, 100],
		columnDefs: [{
			// "targets": [0],
			// "visible": false,
			// "searchable": false
		}],
		"order": [
			[0, "asc"]
		],
		columns: [
			// { data: 'id', name: 'id', searchable: false },
			{ data: 'name', name: 'name' , orderable: false, searchable: true},
			{ data: 'nip', name: 'nip' , orderable: false, searchable: true},
			{ data: 'email', name: 'email' , orderable: false, searchable: true},
			{ data: 'role_formatted', name: 'role' , orderable: false, searchable: true},
			{ data: 'actions', name: 'actions'},
		],
		language: {

		}
	});
}

// delete_button
$(document).on('click', '#delete_button', function () {
	console.log("bla bla bla");

	console.log($(this).data('delete-route'));

	Swal.fire({
		title: "Delete Data  ?",
		text: "Data changes will affect the stored data!",
		icon: "question",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: '#DC3545',
		confirmButtonText: 'Delete!',
		cancelButtonText: 'Cancel!',
	}).then((result) => {
		if (result.isConfirmed) {
			console.log("Ini oke");
		}

		console.log(result);
	})
})

// $.ajax({
// 	headers: {
// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 	},
// 	url: url_delete_vessel_certificate,
// 	type: 'DELETE',
// 	success: function (data) {
// 		toastr.success(data.message)

// 		$('#vessel_certificate_table').DataTable().ajax.reload()
// 	}
// })
