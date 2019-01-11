@extends('layouts.global')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="card card-primary">
			  <div class="card-header">Edit CheckOut
			  	<div class="card-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="card-body">
			  	<form action="{{ route('checkout.update',$checkouts->id) }}" method="post"  enctype="multipart/form-data" >
			  		<input name="_method" type="hidden" value="PATCH">
        			{{ csrf_field() }}
			  		
			  		<div class="form-group {{ $errors->has('nama_depan') ? ' has-error' : '' }}">
			  			<label class="control-label">Nama Depan</label>	
			  			<input type="text" name="nama_depan" class="form-control" value="{{ $checkouts->nama_depan }}"  required>
			  			@if ($errors->has('nama_depan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_depan') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('nama_belakang') ? ' has-error' : '' }}">
			  			<label class="control-label">Nama Belakang</label>	
			  			<input type="text" name="nama_belakang" class="form-control" value="{{ $checkouts->nama_belakang }}"  required>
			  			@if ($errors->has('nama_belakang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_belakang') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('telephone') ? ' has-error' : '' }}">
			  			<label class="control-label">Telephone</label>	
			  			<input type="text" name="telephone" class="form-control" value="{{ $checkouts->telephone }}"  required>
			  			@if ($errors->has('telephone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('alamat_satu') ? ' has-error' : '' }}">
			  			<label class="control-label">Alamat Satu</label>	
			  			<input type="text" name="alamat_satu" class="form-control" value="{{ $checkouts->alamat_satu }}"  required>
			  			@if ($errors->has('alamat_satu'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat_satu') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('alamat_dua') ? ' has-error' : '' }}">
			  			<label class="control-label">Alamat Dua</label>	
			  			<input type="text" name="alamat_dua" class="form-control" value="{{ $checkouts->alamat_dua }}"  required>
			  			@if ($errors->has('alamat_dua'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat_dua') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('negara') ? ' has-error' : '' }}">
			  			<label class="control-label">Negara</label>	
			  			<input type="text" name="negara" class="form-control" value="{{ $checkouts->negara }}"  required>
			  			@if ($errors->has('negara'))
                            <span class="help-block">
                                <strong>{{ $errors->first('negara') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		
			  		<div class="form-group {{ $errors->has('kota') ? ' has-error' : '' }}">
			  			<label class="control-label">Kota</label>
			  			<textarea id="text" type="ckeditor" name="kota" class="ckeditor"required> {{ $checkouts->kota}}
			  			</textarea>
			  			@if ($errors->has('kota'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kota') }}</strong>
                            </span>
                        @endif
			  		</div>

					<div class="form-group {{ $errors->has('daerah') ? ' has-error' : '' }}">
			  			<label class="control-label">Daerah</label>	
			  			<input type="text" name="daerah" class="form-control" value="{{ $checkouts->daerah }}"  required>
			  			@if ($errors->has('daerah'))
                            <span class="help-block">
                                <strong>{{ $errors->first('daerah') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('kode_pos') ? ' has-error' : '' }}">
			  			<label class="control-label">Kode Pos</label>	
			  			<input type="text" name="kode_pos" class="form-control" value="{{ $checkouts->kode_pos }}"  required>
			  			@if ($errors->has('kode_pos'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kode_pos') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group">
			  			<button type="submit" class="btn btn-primary">Edit</button>
			  		</div>
			  	</form>
			  </div>
			</div>	
		</div>
	</div>
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

</div>
@endsection