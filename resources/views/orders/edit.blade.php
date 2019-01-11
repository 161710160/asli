@extends('layouts.global')

@section('title') Ubah order @endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
	</div>
@endif
		<form
			class="shadow-sm bg-white p-3"
			action="{{route('orders.update', ['id' => $order->id])}}"
			method="POST">
		
		@csrf
		
		<input type="hidden" name="_method" value="PUT">
			<label for="invoice_number">Nomer Faktur</label><br>
		<input type="text" class="form-control" value="{{$order->invoice_number}}" disabled>
		<br>

		<label for="">Pembeli</label><br>
			<input disabled class="form-control" type="text" value="{{$order->user->name}}">
		<br>

		<label for="created_at">Tanggal Pesan</label><br>
			<input type="text" class="form-control" value="{{$order->created_at}}"disabled >
		<br>

		<label for="">Produks ({{$order->totalQuantity}}) </label><br>
		<ul>
			@foreach($order->produks as $produk)
		<li>{{$produk->title}} <b>({{$produk->pivot->quantity}})</b></li>
		@endforeach
		</ul>

		<label for="">Jumlah Harga</label>
		<br>
		<input class="form-control" type="text" value="{{$order->total_price}}"disabled>
		<br>

		<label for="status">Status</label><br>
		<select class="form-control" name="status" id="status">
		<option {{$order->status == "SUBMIT" ? "selected" : ""}}value="SUBMIT">SUBMIT</option>
		<option {{$order->status == "PROCESS" ? "selected" : ""}}value="PROCESS">PROCESS</option>
		<option {{$order->status == "FINISH" ? "selected" : ""}}value="FINISH">FINISH</option>
		<option {{$order->status == "CANCEL" ? "selected" : ""}}value="CANCEL">CANCEL</option>
		</select>
		<br>

		<input type="submit" class="btn btn-primary" value="Simpan">
		</form>
	</div>
</div>
@endsection