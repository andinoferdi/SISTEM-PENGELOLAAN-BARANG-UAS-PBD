<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPengadaanController extends Controller
{
    public function index()
    {

        $detailPengadaan = DB::table('detail_pengadaan')
            ->join('barang', 'detail_pengadaan.barang_id', '=', 'barang.barang_id')
            ->join('pengadaan', 'detail_pengadaan.pengadaan_id', '=', 'pengadaan.pengadaan_id')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->select('detail_pengadaan.*', 'barang.nama_barang', 'pengadaan.pengadaan_id', 'vendor.nama_vendor')
            ->get();

        return view('dashboard.detail_pengadaan.index', compact('detailPengadaan'));
    }

    public function create()
    {
        $barang = DB::table('barang')->get();
        $pengadaan = DB::table('pengadaan')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->select('pengadaan.*', 'vendor.nama_vendor')
            ->get();
        return view('dashboard.detail_pengadaan.create', compact('barang', 'pengadaan'));
    }



    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|integer',
        'harga_satuan' => 'required|integer',
        'jumlah' => 'required|integer',
        'pengadaan_id' => 'required|integer',
    ]);

    DB::statement('CALL insert_detail_pengadaan(?, ?, ?, ?)', [
        $request->barang_id,
        $request->harga_satuan,
        $request->jumlah,
        $request->pengadaan_id
    ]);

    return redirect()->route('detail_pengadaan.index')->with('success', 'Detail pengadaan berhasil ditambahkan!');
}

    public function edit($id)
    {
        $detailPengadaan = DB::table('detail_pengadaan')
            ->where('detail_pengadaan_id', $id)
            ->first();

        $barang = DB::table('barang')->get();
        $pengadaan = DB::table('pengadaan')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->select('pengadaan.*', 'vendor.nama_vendor')
            ->get();

        return view('dashboard.detail_pengadaan.edit', compact('detailPengadaan', 'barang', 'pengadaan'));
    }



   public function update(Request $request, $id)
{
    $request->validate([
        'barang_id' => 'required|integer',
        'harga_satuan' => 'required|integer',
        'jumlah' => 'required|integer',
        'pengadaan_id' => 'required|integer', 
    ]);

    $subtotal = $request->harga_satuan * $request->jumlah;

    DB::table('detail_pengadaan')
        ->where('detail_pengadaan_id', $id)
        ->update([
            'barang_id' => $request->barang_id,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'pengadaan_id' => $request->pengadaan_id, 
        ]);

    return redirect()->route('detail_pengadaan.index')->with('success', 'Detail pengadaan berhasil diperbarui!');
}


    public function destroy($id)
    {
        DB::table('detail_pengadaan')
            ->where('detail_pengadaan_id', $id)
            ->delete();

        return redirect()->route('detail_pengadaan.index')->with('success', 'Detail pengadaan berhasil dihapus!');
    }
}
