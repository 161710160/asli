@extends('layouts.global')

@section('title') Ubah Cart @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert alert-success">
		{{session('status')}}
	</div>
		@endif

		<form
			enctype="multipart/form-data"
			method="POST"
			action="{{route('carts.update', ['id' => $cart->id])}}"
			class="p-3 shadow-sm bg-white">
		
		@csrf
		
		<input type="hidden" name="_method" value="PUT">
		<label class="control-label">Nama Produk</label>	
			  			<select name="id_produks" class="form-control">
			  				<option>Nama Produk</option>
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
        <label for="jumlah">Jumlah</label> <br>
		<textarea name="jumlah" id="jumlah"  class="form-control">
		{{$cart->jumlah}}</textarea>
		<br>
        <input type="hidden" name="_method" value="PUT">
		<label class="control-label">Nama User</label>	
			  			<select name="id_users" class="form-control">
			  				<option>Nama Produk</option>
			  				@foreach($users as $data)
			  				<option value="{{ $data->id }}">{{ $data->name }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('id_users'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_users') }}</strong>
                            </span>
                        @endif

		</form>
	</div>
</div>
	@endsection
@section('footer-scripts')
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
		rc.0/css/select2.min.css" rel="stylesheet" />
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
		rc.0/js/select2.min.js"></script>
		
		<script>
		$('#categories').select2({ajax: {url: 'http://e-asleather.pro/ajax/categories/search',
		processResults: function(data){return {
		results: data.map(function(item){return {id: item.id, text:item.name} })
		}
	}
}
		});
		var categories = {!! $cart->categories !!}
		categories.forEach(function(category){
		var option = new Option(category.name, category.id, true, true);
		$('#categories').append(option).trigger('change');
		});
	</script>

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