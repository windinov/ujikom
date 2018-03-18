@extends('welcome')
@section('content')
<div class="container">
	<center><h1>Data pengembalian</h1></center>
	<div class="panel panel-primary">
		<div class="panel-heading">Data pengembalian
		<div class="panel-title pull-right"><a href="{{URL::previous()}}">Kembali</a></div>
	</div>

<div class="panel-body">
	<form action="{{route('kembali.store')}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		
		<div class="form-group">
		<label class="control-lable">Sewa</label>
		<select name="id_sewa" class="form-control">
			@foreach($sewa as $data)
				<option value="{{$data->id}}">{{$data->id}} | {{$data->konsumen->nama}}</option>
			@endforeach
		</select>
		</div>

		<div class="form-group">
		<label class="control-lable">Tanggal hari</label>
		<input type="date" name="tgl_kembali_akhir" class="form-control" required="">
		</div>

		<div class="form-group">
		<label class="control-lable">jumlah hari</label>
		<input type="number" name="jmlh_hari" class="form-control" required="">
		</div>
		

		<div class="form-group">
		<button type="submit" class="btn btn-success">Simpan</button>
		<button type="reset" class="btn btn-danger">Reset</button>
		</div>
</form>
</div>
</div>
@endsection