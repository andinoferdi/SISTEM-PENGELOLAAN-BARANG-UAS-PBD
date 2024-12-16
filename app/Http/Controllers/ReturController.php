<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index()
{
    $retur = DB::table('retur')
        ->join('user', 'retur.user_id', '=', 'user.user_id')
        ->join('penerimaan', 'retur.penerimaan_id', '=', 'penerimaan.penerimaan_id')
        ->join('pengadaan', 'penerimaan.pengadaan_id', '=', 'pengadaan.pengadaan_id')
        ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')  
        ->select('retur.*', 'user.username', 'penerimaan.penerimaan_id', 'vendor.nama_vendor')  
        ->get();

    return view('dashboard.retur.index', compact('retur'));
}

    public function create()
{
    $user = DB::table('user')->get();
    $penerimaan = DB::table('penerimaan')
        ->join('pengadaan', 'penerimaan.pengadaan_id', '=', 'pengadaan.pengadaan_id')
        ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id') 
        ->select('penerimaan.penerimaan_id', 'vendor.nama_vendor', 'penerimaan.created_at')
        ->get();

    return view('dashboard.retur.create', compact('user', 'penerimaan'));
}



    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penerimaan_id' => 'required|integer',
        ]);

        DB::statement('CALL insert_retur(?, ?)', [
            $request->user_id,
            $request->penerimaan_id,
        ]);

        return redirect()->route('retur.index')->with('success', 'Retur berhasil ditambahkan!');
    }

   public function edit($id)
{
    $retur = DB::table('retur')->where('retur_id', $id)->first();
    $user = DB::table('user')->get();
    $penerimaan = DB::table('penerimaan')
        ->join('pengadaan', 'penerimaan.pengadaan_id', '=', 'pengadaan.pengadaan_id')  
        ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')  
        ->select('penerimaan.penerimaan_id', 'vendor.nama_vendor', 'penerimaan.created_at')
        ->get();

    return view('dashboard.retur.edit', compact('retur', 'user', 'penerimaan'));
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penerimaan_id' => 'required|integer',
        ]);

        DB::table('retur')
            ->where('retur_id', $id)
            ->update([
                'user_id' => $request->user_id,
                'penerimaan_id' => $request->penerimaan_id,
            ]);

        return redirect()->route('retur.index')->with('success', 'Retur berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('retur')
            ->where('retur_id', $id)
            ->delete();

        return redirect()->route('retur.index')->with('success', 'Retur berhasil dihapus!');
    }
}
