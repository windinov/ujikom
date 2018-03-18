@extends('welcome')
@section('content')
<div class="container">
	<center><h1>Data Pengembalian</h1></center>
	<div class="panel panel-primary">
	<div class="panel-heading">Data Pengembalian
	<div class="panel-title pull-right"><a href="{{ url('kembali/create') }}">Tambah Data</a></div>
	</div>
	<button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>
<div class="panel-body">
	<table class="table">
	<thead>
		<tr>
			<th>Nama Konsumen</th>
			<th>Tgl Sewa</th>
			<th>Tgl Kembali</th>
			<th>Jumlah Hari</th>
			<th>Telat</th>
			<th>Denda</th>
			<th>Total Harga</th>
			<th colspan="3">Action</th>
		</tr>
	</thead>
	<tbody>
	@foreach($kembali as $data)
	<tr>
	<td>{{$data->sewa->konsumen->nama}}</td>
	<td>{{$data->sewa->created_at}}</td>
	<td>{{$data->tgl_kembali}}</td>
    <td>{{$data->jmlh_hari}}</td>
	<td>{{$data->telat}}</td>
	<td>{{$data->denda}}</td>
	<td>{{$data->total_harga}}</td>
	
	</td>
	   
	   <td>
	   <a class="btn btn-warning" href="/kembali/{{$data->id}}/edit">Edit</a>
	   </td>
	   
	   <td>
	   <form action="{{route('kembali.destroy',$data->id)}}" method="post">

	   <input type="hidden" name="_method" value="DELETE">
	   <input type="hidden" name="_token">
	   <input type="submit" value="DELETE" class="btn btn-danger">
	   {{csrf_field()}}
	   </form>
	   </td>
	   </tr>
	   @endforeach
	   </tbody>
	   </table>
	   </div>
</div>
</div>
@endsection