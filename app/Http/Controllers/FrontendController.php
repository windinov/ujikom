<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;

class FrontendController extends Controller
{
    //
    public function index()
    {
    	$mobil = Mobil::all();
    	return view('tampilanuser.master',compact('mobil'));
    }
}
