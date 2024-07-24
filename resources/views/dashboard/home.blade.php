@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
	<section class="section">
		<div class="section-header">
			<h1>Dashboard</h1>
		</div>

		{{ Request::url() }}

		{{ Request::is('dashboard') }}
		<div class="section-body">
		</div>
	</section>
@endsection

@section('sidebar')

@endsection
