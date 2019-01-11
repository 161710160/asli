@extends('layouts.global')
			
@section('title') Daftar Order @endsection
			
@section('content')

			<form action="{{route('orders.index')}}">
				<div class="row">
					<div class="col-md-5">
						<input value="{{Request::get('buyer_email')}}" name="buyer_email"
						type="text" class="form-control" placeholder="Cari berdasarkan nama pembeli">
					</div>

					<div class="col-md-2">
					<input type="submit" value="Cari" class="btn btn-primary">
					</div>
				</div>
			</form>

			<hr class="my-3">

			<div class="row">
				<div class="col-md-12">
					<table class="table table-stripped table-bordered">
						<thead>
							<tr>
								<th><b>Nomer Faktur</b></th>
								<th><b>Status</b></th>
								<th><b>Pembeli</b></th>
								<th><b>Jumlah Total</b></th>
								<th><b>Tanggal pesan</b></th>
								<th><b>Jumlah Harga</b></th>
								<th><b>Aksi</b></th>
							</tr>
						</thead>
					<tbody>
					@foreach($orders as $order)
					<tr>
						<td>{{$order->invoice_number}}</td>
						<td>
						@if($order->status == "SUBMIT")
							<span class="badge bg-warning text-light">{{$order->status}}</span>
							@elseif($order->status == "PROCESS")
							<span class="badge bg-info text-light">{{$order->status}}
							</span>
							@elseif($order->status == "FINISH")
							<span class="badge bg-success text-light">{{$order->status}}</span>
							@elseif($order->status == "CANCEL")
							<span class="badge bg-dark text-light">{{$order->status}}
						</span>
					@endif
				</td>
				<td>
					{{$order->user->name}} <br>
					<small>{{$order->user->email}}</small>
				</td>
					<td>{{$order->totalQuantity}} pc (s)</td>
					<td>{{$order->created_at}}</td>
					<td>{{$order->total_price}}</td>
				<td>
					<a href="{{route('orders.edit', ['id' => $order->id])}}"
					class="btn btn-info btn-sm"> Ubah</a>
				</td>
			</tr>
			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="10">
						{{$orders->appends(Request::all())->links()}}
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
@endsection