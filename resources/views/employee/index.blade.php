@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
	<section class="section">
		<div class="section-header">
			<h1>Employee Data</h1>
		</div>

		{{ Request::url() }}

		{{ Request::is('dashboard') }}

		<div class="section-body">
			sasa
		</div>
	</section>
@endsection

@section('sidebar')

@endsection
