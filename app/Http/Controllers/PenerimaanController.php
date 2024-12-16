<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaan = DB::table('penerimaan')
            ->join('pengadaan', 'penerimaan.pengadaan_id', '=', 'pengadaan.pengadaan_id')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->join('user', 'penerimaan.user_id', '=', 'user.user_id')
            ->select(
                'penerimaan.*',
                'pengadaan.pengadaan_id',
                'vendor.nama_vendor',
                'user.username'
            )
            ->get();

        return view('dashboard.penerimaan.index', compact('penerimaan'));
    }

    public function create()
    {
        $pengadaan = DB::table('pengadaan')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->select('pengadaan.*', 'vendor.nama_vendor')
            ->get();
        $users = DB::table('user')->get();  
        return view('dashboard.penerimaan.create', compact('pengadaan', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengadaan_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        DB::statement('CALL InsertPenerimaan(?, ?)', [
            $request->pengadaan_id,
            $request->user_id,
        ]);

        return redirect()->route('penerimaan.index')->with('success', 'Penerimaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penerimaan = DB::table('penerimaan')
            ->where('penerimaan_id', $id)
            ->first();

        $pengadaan = DB::table('pengadaan')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->select('pengadaan.*', 'vendor.nama_vendor')
            ->get();

        $users = DB::table('user')->get(); 
        return view('dashboard.penerimaan.edit', compact('penerimaan', 'pengadaan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pengadaan_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        DB::table('penerimaan')
            ->where('penerimaan_id', $id)
            ->update([
                'pengadaan_id' => $request->pengadaan_id,
                'user_id' => $request->user_id,
            ]);

        return redirect()->route('penerimaan.index')->with('success', 'Penerimaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('penerimaan')->where('penerimaan_id', $id)->delete();

        return redirect()->route('penerimaan.index')->with('success', 'Penerimaan berhasil dihapus!');
    }
}
