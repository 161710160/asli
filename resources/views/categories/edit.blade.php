@extends('layouts.global')

@section('title') Edit Kategori Barang @endsection

@section('content')
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif
		<form
			action="{{route('categories.update', ['id' => $category->id])}}"
			enctype="multipart/form-data"
			method="POST"
			class="bg-white shadow-sm p-3">

		@csrf
		
		<input
			type="hidden"
			value="PUT"
			name="_method">
		
		<label>Nama Kategori</label> 
		<br>
		<input
			type="text"
			class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
			value="{{old('name') ? old('name') : $category->name}}"
			name="name">
			<div class="invalid-feedback">
				{{$errors->first('name')}}
		</div>
		<br>
		<br>
		
		<label>Kategori Slug</label>
		<input
			type="text"
			class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}"
			value="{{old('slug') ? old('slug') : $category->slug}}"
			name="slug" readonly>
		<div class="invalid-feedback">
			{{$errors->first('slug')}}
		</div>
		<br>
		<br>
		
		<label> Gambar</label>
		<br>
			@if($category->image)
				<span>Gambar Sebelumnya</span><br>
			<img src="{{asset('storage/'. $category->image)}}" width="120px">
		<br>
		<br>
	@endif
		<input
		type="file" class="form-control {{$errors->first('image') ? "is-invalid" :""}}" name="image">
		<small class="text-muted">Kosongkan jika tidak ingin mengubahgambar</small>
		<div class="invalid-feedback">
			{{$errors->first('image')}}
		</div>
		<br>
		<br>
		<input type="submit" class="btn btn-primary" value="Simpan">
	</form>
</div>
@endsection