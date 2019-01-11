@extends('layouts.global')

@section('title') Edit KategoriArtikel @endsection

@section('content')
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif
		<form
			action="{{route('kategoriartikel.update', ['id' => $kategoriartikels->id])}}"
			enctype="multipart/form-data"
			method="POST"
			class="bg-white shadow-sm p-3">

		@csrf
		
		<input
			type="hidden"
			value="PUT"
			name="_method">
		
		<label>Nama Kategori Artikel</label> 
		<br>
		<input
			type="text"
			class="form-control {{$errors->first('nama_kategori') ? "is-invalid" : ""}}"
			value="{{old('nama_kategori') ? old('nama_kategori') : $kategoriartikels->nama_kategori}}"
			name="nama_kategori">
			<div class="invalid-feedback">
				{{$errors->first('nama_kategori')}}
		</div>
		<br>
		<br>
		<input type="submit" class="btn btn-primary" value="Simpan">
	</form>
</div>
@endsection