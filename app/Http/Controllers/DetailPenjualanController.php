<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenjualanController extends Controller
{
  public function index()
{
    $detailPenjualan = DB::table('detail_penjualan')
        ->join('barang', 'detail_penjualan.barang_id', '=', 'barang.barang_id')
        ->join('penjualan', 'detail_penjualan.penjualan_id', '=', 'penjualan.penjualan_id')
        ->join('user', 'penjualan.user_id', '=', 'user.user_id') 
        ->select('detail_penjualan.*', 'barang.nama_barang', 'penjualan.penjualan_id', 'user.username') 
        ->get();

    return view('dashboard.detail_penjualan.index', compact('detailPenjualan'));
}


    public function create()
    {
        $barang = DB::table('barang')->get();
        $penjualan = DB::table('penjualan')
            ->join('user', 'penjualan.user_id', '=', 'user.user_id')
            ->select('penjualan.penjualan_id', 'user.username')
            ->get();

        return view('dashboard.detail_penjualan.create', compact('barang', 'penjualan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required',
            'harga_satuan' => 'required|integer',
            'jumlah' => 'required|integer',
            'penjualan_id' => 'required'
        ]);

        $subtotal = $validated['harga_satuan'] * $validated['jumlah'];

        DB::table('detail_penjualan')->insert([
            'barang_id' => $validated['barang_id'],
            'harga_satuan' => $validated['harga_satuan'],
            'jumlah' => $validated['jumlah'],
            'subtotal' => $subtotal,
            'penjualan_id' => $validated['penjualan_id'],
        ]);

        return redirect()->route('detail_penjualan.index')->with('success', 'Detail Penjualan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $detailPenjualan = DB::table('detail_penjualan')
            ->where('detail_penjualan_id', $id)
            ->first();

        $barang = DB::table('barang')->get();
        $penjualan = DB::table('penjualan')
            ->join('user', 'penjualan.user_id', '=', 'user.user_id')
            ->select('penjualan.penjualan_id', 'user.username')
            ->get();

        return view('dashboard.detail_penjualan.edit', compact('detailPenjualan', 'barang', 'penjualan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'barang_id' => 'required',
            'harga_satuan' => 'required|integer',
            'jumlah' => 'required|integer',
            'penjualan_id' => 'required'
        ]);

        $subtotal = $validated['harga_satuan'] * $validated['jumlah'];

        DB::table('detail_penjualan')
            ->where('detail_penjualan_id', $id)
            ->update([
                'barang_id' => $validated['barang_id'],
                'harga_satuan' => $validated['harga_satuan'],
                'jumlah' => $validated['jumlah'],
                'subtotal' => $subtotal,
                'penjualan_id' => $validated['penjualan_id'],
            ]);

        return redirect()->route('detail_penjualan.index')->with('success', 'Detail Penjualan berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::table('detail_penjualan')
            ->where('detail_penjualan_id', $id)
            ->delete();

        return redirect()->route('detail_penjualan.index')->with('success', 'Detail Penjualan berhasil dihapus');
    }
}
