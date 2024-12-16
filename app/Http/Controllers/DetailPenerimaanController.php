<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenerimaanController extends Controller
{
    public function index()
    {
        $detailPenerimaan = DB::table('detail_penerimaan')
            ->join('barang', 'detail_penerimaan.barang_id', '=', 'barang.barang_id')
            ->select('detail_penerimaan.*', 'barang.nama_barang')
            ->get();

        return view('dashboard.detail_penerimaan.index', compact('detailPenerimaan'));
    }

    public function create()
    {
        $pengadaan = DB::table('pengadaan')->get();
        $penerimaan = DB::table('penerimaan')->get();

        $barang = DB::table('barang')->get();

        return view('dashboard.detail_penerimaan.create', compact('pengadaan', 'penerimaan',  'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'harga_satuan_terima' => 'required|integer',
            'jumlah_terima' => 'required|integer',
            'penerimaan_id' => 'required|integer',
        ]);

        try {
            $subtotal_terima = $request->harga_satuan_terima * $request->jumlah_terima;

            DB::statement('CALL insert_detail_penerimaan(?, ?, ?, ?, ?)', [
                $request->barang_id,
                $request->harga_satuan_terima,
                $request->jumlah_terima,
                $request->penerimaan_id,
                $subtotal_terima
            ]);

            return redirect()->route('detail_penerimaan.index')->with('success', 'Detail penerimaan berhasil ditambahkan!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Jumlah terima tidak boleh melebihi jumlah pengadaan!');
        }
    }

    public function edit($id)
    {
        $detailPenerimaan = DB::table('detail_penerimaan')
            ->where('detail_penerimaan_id', $id)
            ->first();

        $barang = DB::table('barang')->get();
        $penerimaan = DB::table('penerimaan')->get();

        return view('dashboard.detail_penerimaan.edit', compact('detailPenerimaan', 'barang', 'penerimaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'harga_satuan_terima' => 'required|integer',
            'jumlah_terima' => 'required|integer',
            'penerimaan_id' => 'required|integer',
        ]);

        try {
            $subtotal_terima = $request->harga_satuan_terima * $request->jumlah_terima;

            DB::table('detail_penerimaan')
                ->where('detail_penerimaan_id', $id)
                ->update([
                    'barang_id' => $request->barang_id,
                    'harga_satuan_terima' => $request->harga_satuan_terima,
                    'jumlah_terima' => $request->jumlah_terima,
                    'subtotal_terima' => $subtotal_terima,
                    'penerimaan_id' => $request->penerimaan_id,
                ]);

            return redirect()->route('detail_penerimaan.index')->with('success', 'Detail penerimaan berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Jumlah terima tidak boleh melebihi jumlah pengadaan!');
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('detail_penerimaan')
                ->where('detail_penerimaan_id', $id)
                ->delete();

            return redirect()->route('detail_penerimaan.index')->with('success', 'Detail penerimaan berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus detail penerimaan!');
        }
    }
}
