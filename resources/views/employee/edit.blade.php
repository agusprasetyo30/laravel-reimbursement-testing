@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
<section class="section">
	<div class="section-header">
		<h1>Employee Data</h1>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-header">
				<h4>Edit Employee</h4>
				<div class="card-header-action">
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('employee.store') }}" method="post">
					@csrf
					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

						@error('name')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<label for="password">Password <span class="text-danger">*</span></label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

								@error('password')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-6">
								<label for="password_confirmation">Password Confirmation <span class="text-danger">*</span></label>
								<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>NIP <span class="text-danger">*</span></label>
						<input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}">

						@error('nip')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Email <span class="text-danger">*</span></label>
						<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
						@error('email')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Role / Jabatan <span class="text-danger">*</span></label>
						<select class="form-control @error('role') is-invalid @enderror" name="role">
							<option selected disabled>Pilih role / jabatan</option>
							<option value="direktur">Direktur</option>
							<option value="finance">Finance</option>
							<option value="staff">Staff</option>
						</select>

						@error('role')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					<a href="{{ route('employee.index') }}" class="btn btn-warning" type="reset">
						<i class="fa fa-arrow-left"></i>
						<span>Back</span>
					</a>
					<button class="btn btn-primary mr-1" type="submit">
						<i class="fa fa-save"></i>
						<span> Save</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection
