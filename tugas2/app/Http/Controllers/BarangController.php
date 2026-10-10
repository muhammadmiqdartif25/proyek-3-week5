<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    //
    public function index()
    {
        $barangs = Barang::all();
        $count = count(session('keranjang', []));
        return view('barang.index', compact('barangs', 'count'));
    }
}
