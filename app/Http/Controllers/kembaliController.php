<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kembali;
use App\sewa;
use App\supir;
use App\mobil;

class kembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kembali = kembali::all();
        return view('kembali.index', compact('kembali'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sewa = sewa::all();
        $kembali = kembali::all();
        return view('kembali.create', compact('sewa','kembali'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $kembali = new kembali;
        $kembali->id_sewa = $request->id_sewa;
        $kembali->jmlh_hari = $request->jmlh_hari;
        $kembali->tgl_kembali = $request->tgl_kembali_akhir;

        $telat =$request->jmlh_hari - $kembali->sewa->jmlh_hari;
        $kembali->telat = $telat;

        $denda = $telat * $kembali->sewa->mobil->harga_sewa;
        $kembali->denda = $denda;

        $total= $request->jmlh_hari * $kembali->sewa->mobil->harga_sewa;
        $kembali->total_harga = $total;

        $sewa = sewa::with('supir','mobil')->find($request->id_sewa);
        $supir  = $sewa->supir;
        $supir->update(['status' => 1]); 
        $mobil = $sewa->mobil;
        $mobil->update(['status' => 1]);
        $kembali->save();


        $sewa=sewa::findOrFail($kembali->id_sewa);
        $sewa->status = "Ya";
        $sewa->save();
        return redirect('/kembali');
        // dd($total);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
