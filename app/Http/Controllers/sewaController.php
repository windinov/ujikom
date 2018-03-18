<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sewa;
use App\konsumen;
use App\mobil;
use App\supir;

class sewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supir=supir::all();
        $konsumen=konsumen::all();
        $mobil=mobil::all();
        $sewa= sewa::all();
        return view('sewa.index', compact('mobil','sewa','supir','konsumen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mobil=Mobil::all();
        $supir=Supir::where('status','=',1)->get();
        
        $konsumen =konsumen::all();
        return view('sewa.create', compact('mobil','supir','konsumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = $request->all();

        $mobil = mobil::where('id', $transaksi['mobil_id'])->first();
        $hargasewa = $mobil->harga_sewa;

       if (!empty(supir::where('id', $transaksi['id_supir'])->first())) {
          $supir=supir::where('id', $transaksi['id_supir'])->first();
          
          $konsumen = new sewa;

          $konsumen->status="Tidak";

          $konsumen->jmlh_hari=$request->jmlh_hari;
          $konsumen->total_sewa= ($supir->harga_sewa + $hargasewa) * $request->jmlh_hari;
          $sup = supir::find($transaksi['id_supir']);
          $sup->status = 0;
          $sup->save();
          $mobil = mobil::find($transaksi['mobil_id']);
          $mobil->status = 0;
          $mobil->save();
       }
       else {
        //    dd('kkk');
            $konsumen = new sewa;
            $konsumen->jmlh_hari=$request->jmlh_hari;
            $konsumen->total_sewa= (0 + $hargasewa) * $request->jmlh_hari;
          $konsumen->status="Ya";
            
       }


        $konsumen->konsumen_id=$request->id_konsumen;
        $konsumen->mobil_id=$request->mobil_id;
        $konsumen->supir_id=$request->id_supir;
        //dd($konsumen);
        $konsumen->save();
        return redirect('sewa');
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
        $sewa = sewa::find($id);
        $konsumen = konsumen::all();
        $mobil = mobil::all();
        $supir = supir::all();
        return view('sewa.edit', compact('sewa','konsumen','mobil','supir'));
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
        $transaksi = $request->all();

        $mobil = mobil::where('id', $transaksi['mobil_id'])->first();
        $hargasewa = $mobil->harga_sewa;
       if (!empty(supir::where('id', $transaksi['id_supir'])->first())) {
          $supir=supir::where('id', $transaksi['id_supir'])->first();
          
          $konsumen = sewa::find($id);
          $konsumen->jmlh_hari=$request->jmlh_hari;
          $konsumen->total_sewa= ($supir->harga_sewa + $hargasewa) * $request->jmlh_hari;
          $sup = supir::find($transaksi['id_supir']);
          $sup->status = 1;
          $sup->save();
       }
       else {
        //    dd('kkk');
            $konsumen = sewa::find($id);
            $konsumen->jmlh_hari=$request->jmlh_hari;
            $konsumen->total_sewa= (0 + $hargasewa) * $request->jmlh_hari;
       }


        $konsumen->konsumen_id=$request->id_konsumen;
        $konsumen->mobil_id=$request->mobil_id;
        $konsumen->supir_id=$request->id_supir;
        //dd($konsumen);
        $konsumen->save();
        return redirect('sewa');
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
        $sewa = sewa::findOrFail($id);
        $sewa->delete();
        return redirect('sewa');
    }
}
