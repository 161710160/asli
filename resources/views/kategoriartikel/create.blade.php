@extends('layouts.global')

@section('title') Create kategori Artikel @endsection

@section('content')
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif
	<form
		enctype="multipart/form-data"
		class="bg-white shadow-sm p-3"
		action="{{route('kategoriartikel.store')}}"
		method="POST">
	
	@csrf
	<div class="card-body">
		<form action="{{ route('kategoriartikel.store') }}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group {{$errors->has('nama_kategori') ? 'has-error' : '' }}">
				<label class="control-label">Nama Kategori</label>
				<input type="text"  name="nama_kategori" class="form-control" required>
				@if ($errors->has('nama_kategori'))
				<span class="help-block"><strong>{{ $errors->first('nama_kategori') }}</strong></span>
				@endif
			</div>

			<div class="from-group">
				<button type="submit" class="btn btn-primary">Tambah</button>
			</div>

		</form>
	</div>
</div>
</div>
</div>
</div>
@endsection


