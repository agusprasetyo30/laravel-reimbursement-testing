@extends('layouts.app')

@section('title', 'Create Reimbursement')

@push('css')
@endpush

@section('content')
<section class="section">
	<div class="section-header">
		<h1>Reimbursement Data</h1>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-header">
				<h4>Create Reimbursement</h4>
				<div class="card-header-action">
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('reimbursement.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Date</label>
						<input type="text" class="form-control datepicker" name="date">
					</div>
					<div class="form-group">
						<label>Reimbursement Name <span class="text-danger">*</span></label>
						<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

						@error('name')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<textarea class="summernote-simple" name="description"></textarea>

								@error('description')
									<small class="text-danger">* {{ $message }}</small>
								@enderror
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Upload Document <span class="text-danger">*</span></label>
						<input type="file" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('nip') }}" accept=".pdf, image/png, image/jpeg, image/jpg">
						@error('document')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

						<small id="passwordHelpBlock" class="form-text text-muted">
							<span class="fa fa-info-circle"></span>  Allowed type (Image & .PDF)
						</small>
					</div>
					<a href="{{ route('reimbursement.index') }}" class="btn btn-warning" type="reset">
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

@push('js')

<script>
		$('.datepicker').daterangepicker({
			locale: {format: 'YYYY-MM-DD'},
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1901,
    		maxYear: parseInt(moment().format('YYYY'),10)
		});

		$(".summernote-simple").summernote({
			dialogsInBody: true,
			minHeight: 150,
			toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough']],
				['para', ['paragraph']]
			]
		});
	</script>
@endpush
