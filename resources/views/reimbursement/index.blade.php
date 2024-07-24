@extends('layouts.app')

@section('title', 'Reimbursement')

@section('content')
	<section class="section">
		<div class="section-header">
			<h1>Reimbursement</h1>
		</div>

		{{ Request::url() }}

		{{ Request::is('dashboard') }}

		<div class="section-body">
			Reimbursement
		</div>
	</section>
@endsection

@section('sidebar')

@endsection
