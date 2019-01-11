@extends('layouts.global')

@section('title') Trashed produks @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert alert-success">
		{{session('status')}}
			</div>
		@endif

		<div class="row">
			<div class="col-md-6">

		<form action="{{route('produks.index')}}">
			<div class="input-group">

		<input name="keyword" type="text" value="
					 {{Request::get('keyword')}}" class="form-control" placeholder="Filter by title">
			<div class="input-group-append">
				<input type="submit" value="Filter" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

			<div class="col-md-6">
				<ul class="nav nav-pills card-header-pills">
					<li class="nav-item">
						<a class="nav-link {{Request::get('status') == NULL &&
								  Request::path() == 'produks' ? 'active' : ''}}" href="
								  {{route('produks.index')}}">All</a>
					</li>

			<li class="nav-item">
				<a class="nav-link {{Request::get('status') == 'publish' ?
					   	 'active' : '' }}" href="{{route('produks.index', ['status' =>
						 'publish'])}}">Publish</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{Request::get('status') == 'draft' ?
						 'active' : '' }}" href="{{route('produks.index', ['status' =>
						 'draft'])}}">Draft</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{Request::path() == 'produks/trash' ?
						 'active' : ''}}" href="{{route('produks.trash')}}">Trash</a>
						</li>
					</ul>
				</div>
			</div>

			<hr class="my-3">

			<div class="row mb-3">
				<div class="col-md-12 text-right">
					<a href="{{route('produks.create')}}" class="btn btn-primary" >Create produk</a>
				</div>
			</div>

			<table class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th><b>Cover</b></th>
						<th><b>Title</b></th>
						<th><b>Author</b></th>
						<th><b>Categories</b></th>
						<th><b>Stock</b></th>
						<th><b>Price</b></th>
						<th><b>Action</b></th>
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
						<td>{{$produk->author}}</td>
						<td>

					{{ $produk->categories->name }}
					</td>
								<td>{{$produk->stock}}</td>
								<td>{{$produk->price}}</td>
								<td>
				<form
					method="POST"
					action="{{route('produks.restore', ['id' => $produk->id])}}"class="d-inline">
				
			@csrf

				<input type="submit" value="Restore" class="btn btn-success"/>
		</form>
				<form
					method="POST"
					action="{{route('produks.delete-permanent', ['id' =>$produk->id])}}"
					class="d-inline"
					onsubmit="return confirm('Delete this produk permanently?')">

			@csrf

					<input type="hidden" name="_method" value="DELETE">
					<input type="submit" value="Delete" class="btn btn-danger btn-sm">
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