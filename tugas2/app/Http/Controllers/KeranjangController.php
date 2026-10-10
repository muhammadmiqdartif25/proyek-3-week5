<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class KeranjangController extends Controller
{
    //
    public function index(){
        $keranjang = session('keranjang', []);
        $barangs = Barang::whereIn('id', array_keys($keranjang))->get();
        $keranjang = array_intersect_key($keranjang, $barangs->keyBy('id')->all());
        session(['keranjang' => $keranjang]);

        $items = $barangs->map(fn ($barang) => (object) [
            'barang' => $barang,
            'qty' => $keranjang[$barang->id],
            'subtotal' => $barang->harga * $keranjang[$barang->id],
        ]);
        $total = $items->sum(fn ($item) => $item->subtotal);

        return view('keranjang.index', compact('items', 'total'));
    }

    public function store(Barang $barang){
        $keranjang = session('keranjang', []);
        $qty = ($keranjang[$barang->id] ?? 0) + 1;

        if ($qty > $barang->stok) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $keranjang[$barang->id] = $qty;
        session(['keranjang' => $keranjang]);
        return back()->with('success', "{$barang->nama} berhasil ditambahkan ke keranjang");
    }

    public function update(Request $request, Barang $barang){
        $validated = $request->validate([
            'delta' => ['required', 'integer', 'in:-1,1'],
        ]);

        $keranjang = session('keranjang', []);

        $tempQty = ($keranjang[$barang->id] ?? 0) + $validated['delta'];

        if ($tempQty > $barang->stok) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }else if ($tempQty < 1) {
            unset($keranjang[$barang->id]);

        }else{
            $keranjang[$barang->id] = $tempQty;
        }

        session(['keranjang' => $keranjang]);

        return back();

    }

    public function destroy(Barang $barang){
        $keranjang = session('keranjang', []);
        unset($keranjang[$barang->id]);
        session(['keranjang' => $keranjang]);

        return back()->with('success', "{$barang->nama} berhasil dihapus dari keranjang");
    }

    public function clear(){
        session()->forget('keranjang');
        return back()->with('success', 'Keranjang berhasil dikosongkan');
    }
}
