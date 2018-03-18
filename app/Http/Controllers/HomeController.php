<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use App\Supir;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request) { 
        $query = $request->get('r');
            if (Mobil::Where('merk', 'LIKE', '%' . $query . '%')->get()!=null) {
                    $mobil = Mobil::Where('merk', 'LIKE', '%' . $query . '%')->get();
                    return view('cari', compact('mobil'));
            }
            elseif (Supir::Where('nama', 'LIKE', '%' . $query . '%')->get()!=null) {
                    $Supir = Supir::Where('nama', 'LIKE', '%' . $query . '%')->get();
                    dd(Mobil::Where('merk', 'LIKE', '%' . $query . '%')->get()!=null);
                    return view('cari2', compact('Supir'));
                # code...
            }
    // $jenis = katagori::all(); 

    }

}
