@extends('layouts.global')
@section('title') Daftar Kategori Artikel @endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<form action="{{route('kategoriartikel.index')}}">
	<div class="input-group">

			<input
				type="text"
				class="form-control"
				placeholder="Cari berdasarkan nama kategori"
				value="{{Request::get('nama_kategori')}}"
				name="nama_kategori">
			
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
				<a href="{{route('kategoriartikel.create')}}" class="btn btn-primary">Tambah Data</a>
				</div>
			</div>
            <br>


			  			  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			  	@include('sweet::alert')
                  <div class="row">
				<div class="col-md-12">
					<table id="kategoriartikel" class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th><b>Nama Kategori</b></th>
								<th><b>Slug</b></th>
								<th><b>Actions</b></th>
							</tr>
						</thead>
			
			<tbody>
				@foreach ($kategoriartikels as $data)
					<tr>
						<td>{{$data->nama_kategori}}</td>
						<td>{{$data->slug}}</td>
						<td>
			<a
				href="{{route('kategoriartikel.edit', ['id' => $data->id])}}"
				class="btn btn-info btn-sm"> Ubah </a>
			
			<form
				class="d-inline"
				action="{{route('kategoriartikel.destroy', ['id' => $data->id])}}"
				method="POST"
				>
			
			@csrf
			
			<input
				type="hidden"
				value="DELETE"
				name="_method">
			
			<input
				type="submit"
                onclick="return confirm('Yakin ingin menhapus KategoriArtikel ini?')"
				class="btn btn-danger btn-sm"
				value="Hapus">
			</form>
		</td>
	</tr>
@endforeach
		</tbody>
				  </table>
				 
				</div>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection

	    