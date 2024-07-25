$(document).ready(function () {
	generateDatatables()
})

// Generate index datatables
function generateDatatables() {
	$('#reimbursement_table').DataTable({
		// responsive: true,
		processing: true,
		serverSide: true,
		bDestroy: true,
		ordering: false,
		ajax: $('#reimbursement_table').data('table-route'),
		lengthMenu: [5, 10, 25, 50, 100],
		columnDefs: [{

		}],
		columns: [
			{ data: 'date_formatted', name: 'date' , orderable: false, searchable: true},
			{ data: 'name', name: 'name' , orderable: false, searchable: true},
			{ data: 'description', name: 'description' , orderable: false, searchable: true},
			{ data: 'document_formatted', name: 'document_file_path' , orderable: false, searchable: true},
			{ data: 'status_formatted', name: 'status' , orderable: false, searchable: true, className: "dt-center "},
			{ data: 'actions', name: 'actions', className: "dt-center"},
		],
		language: {

		}
	});
}

// delete_button
$(document).on('click', '#delete_button', function () {
	let table   = $('#reimbursement_table').DataTable();
	let data_row = table.row($(this).parents('tr')).data(); // Ini digunakan ketika hanya 1 table aja tanpa tambahan div/class baru

	let url = $(this).data('delete-route')
	let url_fix = url.replace(':id', data_row['id'])

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
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: url_fix,
				type: 'DELETE',
				success: function (data) {
					if (data.error == 0) {
						toast.fire({
							icon: 'success',
							title: data.message
						})

						$('#reimbursement_table').DataTable().ajax.reload()
					}

					// Muncul alert error ketika tidak lolos validasi
					if (data.error == 1) {
						if (data.code == 'validation') {
							$.each(data.message, function (index, message) {
								toast.fire({
									icon: 'error',
									title: data.message
								})
							})
						} else {
							$.each(data.message, function (index, message) {
								toast.fire({
									icon: 'error',
									title: data.message
								})
							})
						}
					}
				}
			})
		}
	})
})

// Approve Button
$(document).on('click', '#approve_button', function () {
	let table   = $('#reimbursement_table').DataTable();
	let data_row = table.row($(this).parents('tr')).data(); // Ini digunakan ketika hanya 1 table aja tanpa tambahan div/class baru

	let url = $(this).data('approve-route')
	let url_fix = url.replace(':id', data_row['id'])

	let data = []
	data['reimbursement_id'] = data_row['id']

	Swal.fire({
		title: "Approve Reimbursement  ?",
		text: "The data is used for the next reimbursement process!",
		icon: "question",
		showCancelButton: true,
		showDenyButton: true,
		allowOutsideClick: false,
		confirmButtonColor: '#2B753B',
		confirmButtonText: 'Approve',
		denyButtonText: 'Rejected',
		cancelButtonText: 'Cancel',
		// input: 'text',
		// inputPlaceholder: 'Input note if rejected ...',
	}).then((result) => {
		let status = ""
		let rejectedNote = ""

		if (result.isConfirmed) {
			data['status'] = 1 // Approved

			saveApprovalTransaction(url_fix, data)
		} else if (result.isDenied) {
			data['status'] = 0 // Rejected

			Swal.fire({
				icon: "info",
				title: "Provide a note when rejected",
				text: "Notes are used for notes that will be used in recording reimbursements",
				input: "text",
				showCancelButton: true,
			}).then((noteResult) => {
				if (noteResult.isConfirmed) {
					data['note'] = noteResult.value

					saveApprovalTransaction(url_fix, data)
				}
			})
		}
	})
})

// save data approval with sweetalert2 confirm
function saveApprovalTransaction(url, data) {
	$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: 'post',
			data: {
				_token: $('input[name=_token]').val(),
				reimbursement_id: data['reimbursement_id'],
				status: data['status'],
				note: data['note'],
			},
			success: function (data) {
				if (data.error == 0) {
					toast.fire({
						icon: 'success',
						title: data.message
					})

					$('#reimbursement_table').DataTable().ajax.reload()
				}

				// Muncul alert error ketika tidak lolos validasi
				if (data.error == 1) {
					if (data.code == 'validation') {
						$.each(data.message, function (index, message) {
							toast.fire({
								icon: 'error',
								title: data.message
							})
						})
					} else {
						$.each(data.message, function (index, message) {
							toast.fire({
								icon: 'error',
								title: data.message
							})
						})
					}
				}
			}
		})
}
