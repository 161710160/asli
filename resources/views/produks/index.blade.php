@extends('layouts.global')

@section('title') Daftar Barang  @endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<form action="{{route('produks.index')}}">
	<div class="input-group">

			<input
				type="text"
				class="form-control"
				placeholder="Cari berdasarkan nama produk"
				value="{{Request::get('title')}}"
				name="title">
			
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

		<hr class="my-3">

		<div class="row mb-3">
			<div class="col-md-12 text-right">
		<a
		href="{{route('produks.create')}}" class="btn btn-primary">Tambah Data</a>
		</div>
	</div>

		<table class="table table-bordered table-stripped">
			<thead>
				<tr>
					<th><b>Gambar</b></th>
					<th><b>Nama Barang</b></th>
					<th><b>Status</b></th>
					<th><b>Deskripsi</b></th>
					<th><b>Kategori</b></th>
					<th><b>Stock</b></th>
					<th><b>Harga</b></th>
					<th><b>Aksi</b></th>
				</tr>
		</thead>
	<tbody>
		@foreach($produks as $produk)
		<tr>
			<td>
				@if($produk->cover)
					<img src="{{asset('storage/' . $produk->cover)}}" width="96px"/>
		@endif
	</td>
					<td>{{$produk->title}}</td>
					<td>
				@if($produk->status == "DRAFT")
		<span class="badge bg-dark text-white">{{$produk->status}}
	</span>
		
		@else
			<span class="badge badge-success">{{$produk->status}}
	</span>
		@endif
	</td>
			<td>{!!$produk->description!!}</td>
		
		<td>
			
		{{ $produk->categories->name }}
		</td>
					<td>{{$produk->stock}}</td>
					<td>{{$produk->price}}</td>
					<td>
	<a href="{{route('produks.edit', ['id' => $produk->id])}}"class="btn btn-info btn-sm"> Ubah </a>
	
		<form
			method="POST"
			class="d-inline"
			onsubmit="return confirm('Yakin ingin menghapus Barang ini?')"
			action="{{route('produks.destroy', ['id' => $produk->id
			])}}">
		
		@csrf
		
		<input
			type="hidden"
			value="DELETE"
			name="_method">
		<input
			type="submit"
			value="Hapus"
			class="btn btn-danger btn-sm">
		</form>
	</td>
</tr>
			@endforeach
		</tbody>
			<tfoot>
				<tr>
					<td colspan="10">
						{{$produks->appends(Request::all())->links()}}
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
@endsection

@push('scripts')
<style type="text/css" src="{{ asset ('/css/datatable.css')}}"></style>
<script type="text/javascript" src="{{asset('/js/datatable.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/datatable.min.js')}}"></script>
<script type="text/javascript">
	$('#categories').DataTable({
	});
</script>
@endpush