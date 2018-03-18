@extends('welcome')
@section('content')
<div class="container">
	<center><h1>Data sewa</h1></center>
	<div class="panel panel-primary">
		<div class="panel-heading">Data sewa
		<div class="panel-title pull-right"><a href="{{URL::previous()}}">Kembali</a></div>
	</div>

<div class="panel-body">
	<form action="{{route('sewa.update',$sewa->id)}}" method="post" enctype="multipart/form-data">
	<Input type="hidden" name="_method" value="PUT">
			{{csrf_field()}}


		<div class="form-group">
		<label class="control-lable">jumlah hari</label>
		<input type="number" name="jmlh_hari" class="form-control" required="" value="{{$sewa->jmlh_hari}}">
		</div>

		<div class="form-group">
		<label class="control-lable">nama konsumen</label>
		<select class="form-control" name="id_konsumen">
			@foreach($konsumen as $data)
			<option value="{{$data->id}}">{{$data->nama}}</option>
			@endforeach
		</select>
		</div>

		<div class="form-group">
		<label class="control-lable">merk mobil</label>
		<select class="form-control" name="mobil_id">
			@foreach($mobil as $data)
			<option value="{{$data->id}}">{{$data->merk}}</option>
			@endforeach
		</select>
		</div>

		<div class="form-group">
		<label class="control-lable"> supir</label>
		<select class="form-control" name="id_supir">
		<option value="0">Tidak menyewa supir</option>
			@foreach($supir as $data)
			<option value="{{$data->id}}">{{$data->nama}}</option>
			@endforeach
		</select>
		</div>

		<div class="form-group">
		<button type="submit" class="btn btn-success">Simpan</button>
		<button type="reset" class="btn btn-danger">Reset</button>
		</div>
</form>
</div>
</div>
@endsection