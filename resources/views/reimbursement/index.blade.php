@extends('layouts.app')

@section('title', 'Reimbursement')

@section('content')
	<section class="section">
		<div class="section-header">
			<h1>Reimbursement</h1>
		</div>
		<div class="section-body">
			<div class="card card-primary">
				<div class="card-header">
					<h4>Reimbursement List</h4>
					<div class="card-header-action">
						@can('create-reimbursement')
							<a href="{{ route('reimbursement.create') }}" class="btn btn-primary">
								<i class="fa fa-plus"></i>
								<span> Add Reimbursement</span>
							</a>
						@endcan
					</div>
				</div>
				<div class="card-body">
					<table class="table table-striped table-hover" id="reimbursement_table" data-table-route="{{ route('datatables.reimbursement') }}">
						<thead>
							<tr>
								<th class="align-middle" width="10%">Date</th>
								<th class="align-middle" width="20%">Reimburse Name</th>
								<th class="align-middle" width="25%">Description</th>
								<th class="align-middle" width="10%">Document</th>
								<th class="align-middle" width="15%">Approval Status</th>
								{{-- <th class="align-middle" width="10%">Approved By</th> --}}
								<th class="align-middle" width="15%"></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection

@push('js')
	<script src="{{ asset('js/reimbursement.js') }}"></script>
@endpush
