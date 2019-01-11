@extends('layouts.global')

@section('title') Daftar Kategori Barang @endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<form action="{{route('categories.index')}}">
	<div class="input-group">

			<input
				type="text"
				class="form-control"
				placeholder="Cari berdasarkan nama kategori"
				value="{{Request::get('name')}}"
				name="name">
			
			<div class="input-group-append">
			<input
				type="submit"
				value="Cari"
				class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
			
</div>

			<hr class="my-3">

		@if(session('status'))
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-warning">
						{{session('status')}}
					</div>
				</div>
			</div>
		@endif

			<div class="row">
					<div class="col-md-12 text-right">
				<a href="{{route('categories.create')}}" class="btn btn-primary">Tambah Data</a>
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-12">
					<table id="categories" class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th><b>Nama Kategori</b></th>
								<th><b>Gambar</b></th>
								<th><b>Aksi</b></th>
							</tr>
						</thead>
			
			<tbody>
				@foreach ($categories as $category)
					<tr>
						<td>{{$category->name}}</td>
						<td>
							@if($category->image)
							<img src="{{asset('storage/' . $category->image)}}"width="48px"/>
						@else
							No image
						@endif
						</td>
						<td>
			<a
				href="{{route('categories.edit', ['id' => $category->id])}}"
				class="btn btn-info btn-sm"> Ubah </a>
			
			<a
				href="{{route('categories.show', ['id' => $category->id])}}"
				class="btn btn-primary"> Lihat </a>
			
			<form
				class="d-inline"
				action="{{route('categories.destroy', ['id' => $category->id])}}"
				method="POST"
				>
			
			@csrf
			
			<input
				type="hidden"
				value="DELETE"
				name="_method">
			
			<input
				type="submit"
				onclick="return confirm('Yakin ingin menghapus Kategori ini?')"
				class="btn btn-danger btn-sm"
				value="Hapus">
			</form>
		</td>
	</tr>
@endforeach
		</tbody>
	<tfoot>
<tr>
			<td colSpan="10">
			{{$categories->appends(Request::all())->links()}}
		</td>
	</tr>
</tfoot>
	</table>
			</div>
				</div>
@endsection

@push('scripts')
<style type="text/css" src="{{ asset ('public/css/datatable.css')}}"></style>
<script type="text/javascript" src="{{asset('public/js/datatable.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/datatable.min.js')}}"></script>
<script type="text/javascript">
	$('#categories').DataTable({
	});
</script>
@endpush