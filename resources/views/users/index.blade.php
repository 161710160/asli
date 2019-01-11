@extends("layouts.global")
@section("title") Daftar Users @endsection
@section("content")
<form action="{{route('users.index')}}">
	<div class="row">
	<div class="col-md-6">
		<input
			value="{{Request::get('keyword')}}"
			name="keyword"
			class="form-control"
			type="text"
			placeholder="Masukan email untuk filter..."/>
	</div>
	<div class="col-md-6">
		
		
		<input
			type="submit"
			value="Filter"
			class="btn btn-primary">
		</div>
	</div>
</form>
				<br>
				@if(session('status'))
					<div class="alert alert-success">
				{{session('status')}}
			</div>
				@endif
				
				<div class="row">
					<div class="col-md-12 text-right">
				<a href="{{route('users.create')}}" class="btn btn-primary">Tambah Data</a>
				</div>
			</div>

				<br>
				<table class="table table-bordered">
				<thead>
				<tr>
				<th><b>Nama</b></th>
				<th><b>Username</b></th>
				<th><b>Email</b></th>
				<th><b>Foto</b></th>
				<th><b>Alamat</b></th>
				<th><b>Status</b></th>
				<th><b>Aksi</b></th>
			</tr>
		</thead>
	<tbody>

				@foreach($users as $user)
				<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->username}}</td>
				<td>{{$user->email}}</td>
				<td>
				@if($user->avatar)
				<img src="{{asset('storage/'.$user->avatar)}}" width="70px"/>
				@else
					N/A
				@endif
			</td>
			<td>{{$user->address}}</td>
				
				<td>
				@if($user->status == "ACTIVE")
				<span class="badge badge-success">
				{{$user->status}}
			</span>

				@else
				<span class="badge badge-danger">
				{{$user->status}}
			</span>
				@endif
			</td>

				<td>
				<a
					href="{{route('users.show', ['id' => $user->id])}}"
					class="btn btn-primary btn-sm">Lihat</a>
				
				<form
					onsubmit="return confirm('Yakin ingin menghapus User ini?')"
					class="d-inline"
					action="{{route('users.destroy', ['id' => $user->id ])}}"
					method="POST">
				@csrf

				<input type="hidden" name="_method" value="Hapus">
				
				<input type="submit" value="Hapus" class="btn btn-danger btn-sm">
				</form>
			</td>
		</tr>
			@endforeach
	</tbody>
	<tfoot>
				<tr>
					<td colspan=10>{{$users->links()}}
				</td>
			</tr>
		</tfoot>
</table>
@endsection
