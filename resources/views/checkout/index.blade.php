@extends('layouts.global')

@section('title') Daftar Checkouts @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert alert-success">
		{{session('status')}}
	</div>
		@endif
<div class="row">

  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>
<div class="row mb-3">
			<div class="col-md-12 text-right">

		<table class="table table-bordered table-stripped">
			<thead>
              <tr>
                <th><b>Nama Depan</b></th>
                <th><b>Nama Belakang</b></th>
                <th><b>Telephone</b></th>
                <th><b>Alamat Satu</b></th>
                <th><b>Alamat Dua</b></th>
                <th><b>Negara</b></th>
                <th><b>Kota</b></th>
                <th><b>Daerah</b></th>
                <th><b>Kode Pos</b></th>
                <th><b>Action</b></th>
              </tr>
            </thead>
            <tbody>
              @foreach($checkouts as $data)
              <tr>
                  <td>{{$data->nama_depan}}</td>
                  <td>{{$data->nama_belakang}}</td>
                  <td>{{$data->telephone}}</td>
                  <td>{{$data->alamat_satu}}</td>
                  <td>{{$data->alamat_dua}}</td>
                  <td>{{$data->negara}}</td>
                  <td>{{$data->kota}}</td>
                  <td>{{$data->daerah}}</td>
                  <td>{{$data->kode_pos}}</td>
                  <td>
	<a href="{{route('carts.edit', ['id' => $cart->id])}}"class="btn btn-info btn-sm"> Edit </a>
	
		<form
			method="POST"
			class="d-inline"
			onsubmit="return confirm('Move cart to trash?')"
			action="{{route('carts.destroy', ['id' => $cart->id
			])}}">
		
		@csrf
		
		<input
			type="hidden"
			value="DELETE"
			name="_method">
		<input
			type="submit"
			onclick="return confirm('Yakin ingin menghapus Checkout ini?')"
			value="Hapus"
			class="btn btn-danger btn-sm">
		</form>
	</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{--  {!! $checkouts->links() !!} --}}
    </div>
  </div>
</div>
</div>
@endsection