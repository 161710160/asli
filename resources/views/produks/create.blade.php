@extends('layouts.global')

@section('title') Tambah Data Barang @endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
	</div>
@endif

		<form
			action="{{route('produks.store')}}"
			method="POST"
			enctype="multipart/form-data"
			class="shadow-sm p-3 bg-white">

		@csrf
		
		<label for="title">Nama Barang</label> <br>
		<input 
			value="{{old('title')}}" 
			type="text" 
			class="form-control{{$errors->first('title') ? "is-invalid" : ""}} " 
			name="title"
			placeholder="Produk title">
		<div class="invalid-feedback">
			{{$errors->first('title')}}
		</div>
		<br>

		<label for="cover">Gambar</label>
		<input 
			type="file" 
			class="form-control {{$errors->first('cover') ?"is-invalid" : ""}} " 
			name="cover">
		<div class="invalid-feedback">
			{{$errors->first('cover')}}
		</div>
		<br>

		<label for="description">Deskripsi</label><br>
		<textarea 
			name="description" 
			id="description"
			type="ckeditor" 
			class="ckeditor" 
			placeholder="Give adescription about this Produk">{{old('description')}}</textarea>
		<div class="invalid-feedback">
			{{$errors->first('description')}}
		</div>
		<br>

		<label class="control-label">Kategori</label>	
			  			<select name="id_categories" class="form-control">
			  				<option>Pilih Kategori</option>
			  				@foreach($categories as $data)
			  				<option value="{{ $data->id }}">{{ $data->name }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('id_categories'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_categories') }}</strong>
                            </span>
                        @endif
		<br>
		<br>

		<label for="stock">Stock</label><br>
		<input 
			value="{{old('stock')}}" 
			type="number" 
			class="form-control{{$errors->first('stock') ? "is-invalid" : ""}} " 
			id="stock" name="stock" min=0 value=0>
		<div class="invalid-feedback">
			{{$errors->first('stock')}}
		</div>
		<br>

		<label for="Price">Harga</label> <br>
		<input 
			value="{{old('price')}}" 
			type="number" 
			class="form-control {{$errors->first('price') ? "is-invalid" : ""}} " 
			name="price" id="price"
			placeholder="Produk price">
		<div class="invalid-feedback">
			{{$errors->first('price')}}
		</div>
		<br>

		<button class="btn btn-primary" name="save_action"value="PUBLISH">Publish</button>
		<button class="btn btn-secondary" name="save_action"value="DRAFT">Save as draft</button>
		</form>
	</div>
</div>
@endsection
		
@section('footer-scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" 
	  rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		
<script>
		$('#categories').select2({
		ajax: {
		url: 'http://e-asleather.pro/ajax/categories/search',
		processResults: function(data){
		return {
		results: data.map(function(item){return {id: item.id, text:
		item.name} })
			}
		}
	}
});
</script>

<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
  };
  CKEDITOR.replace( 'text',options);
</script>

@endsection