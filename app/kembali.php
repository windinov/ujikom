<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kembali extends Model
{
    //
    protected $table="kembalis";
    protected $fillable=['id','tgl_kembali','jmlh_hari','telat','denda','total_harga'];
    protected $visible=['id','tgl_kembali','jmlh_hari','telat','denda','total_harga'];

    public function sewa(){
    	return $this->belongsTo('App\sewa','id_sewa');
    }
}
