@extends('layouts.global')

@section('title') Tambah Data Cart @endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
	</div>
@endif

		<form
			action="{{route('carts.store')}}"
			method="POST"
			enctype="multipart/form-data"
			class="shadow-sm p-3 bg-white">

		@csrf
		
		<label class="control-label">Nama Produk</label>	
			  			<select name="id_produks" class="form-control">
			  				<option>Pilih Produk</option>
			  				@foreach($produks as $data)
			  				<option value="{{ $data->id }}">{{ $data->title }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('id_produks'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_produks') }}</strong>
                            </span>
                        @endif
		<br>
		<br>

		<label for="jumlah">Jumlah</label>
		<input 
			type="number" 
			class="form-control {{$errors->first('jumlah') ?"is-invalid" : ""}} " 
			name="jumlah">
		<div class="invalid-feedback">
			{{$errors->first('jumlah')}}
		</div>
		<br>

		<label class="control-label">User</label>	
			  			<select name="id_users" class="form-control">
			  				<option>Pilih User</option>
			  				@foreach($users as $data)
			  				<option value="{{ $data->id }}">{{ $data->name }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('id_users'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_users') }}</strong>
                            </span>
                        @endif
		<br>
		<br>

		<button class="btn btn-primary" name="save_action"value="PUBLISH">Publish</button>
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