@extends('layouts.global')

@section('title') Lihat Kategori Barang @endsection

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<label><b>Nama Kategori</b></label><br>
			{{$category->name}}
			<br><br>

			<label><b>slug Kategori</b></label><br>
			{{$category->slug}}
			<br><br>

			<label><b>Gambar</b></label><br>
			@if($category->image)
			<img src="{{asset('storage/' . $category->image)}}" width="120px">
			@endif
		</div>
	</div>
</div>
@endsection