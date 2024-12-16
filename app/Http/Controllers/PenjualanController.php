<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{

    public function index()
    {
        $penjualan = DB::table('penjualan')
            ->join('user', 'penjualan.user_id', '=', 'user.user_id')
            ->join('margin_penjualan', 'penjualan.margin_penjualan_id', '=', 'margin_penjualan.margin_penjualan_id')
            ->select('penjualan.*', 'user.username', 'margin_penjualan.persen')
            ->get();

        return view('dashboard.penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $users = DB::table('user')->get();
        $margin_penjualan = DB::table('margin_penjualan')->get();
        return view('dashboard.penjualan.create', compact('users', 'margin_penjualan'));
    }

    public function edit($id)
    {
        $penjualan = DB::table('penjualan')->where('penjualan_id', $id)->first();
        $users = DB::table('user')->get();
        $margin_penjualan = DB::table('margin_penjualan')->get();

        if (!$penjualan) {
            abort(404, 'Data penjualan tidak ditemukan.');
        }

        return view('dashboard.penjualan.edit', compact('penjualan', 'users', 'margin_penjualan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'margin_penjualan_id' => 'required|integer',
            'subtotal_nilai' => 'required|integer',
            'ppn' => 'required|numeric|min:0|max:100',
        ]);

        $marginPenjualan = DB::table('margin_penjualan')
            ->where('margin_penjualan_id', $request->margin_penjualan_id)
            ->first();

        $margin = ($marginPenjualan->persen / 100) * $request->subtotal_nilai;
        $ppn = ($request->ppn / 100) * $request->subtotal_nilai;
        $totalNilai = $request->subtotal_nilai + $margin + $ppn;

        DB::table('penjualan')->insert([
            'user_id' => $request->user_id,
            'margin_penjualan_id' => $request->margin_penjualan_id,
            'subtotal_nilai' => $request->subtotal_nilai,
            'ppn' => $request->ppn,
            'total_nilai' => $totalNilai,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'margin_penjualan_id' => 'required|integer',
            'subtotal_nilai' => 'required|integer',
            'ppn' => 'required|numeric|min:0|max:100',
        ]);

        $marginPenjualan = DB::table('margin_penjualan')
            ->where('margin_penjualan_id', $request->margin_penjualan_id)
            ->first();

        $margin = ($marginPenjualan->persen / 100) * $request->subtotal_nilai;

        $ppn = ($request->ppn / 100) * $request->subtotal_nilai;

        $totalNilai = $request->subtotal_nilai + $margin + $ppn;

        DB::table('penjualan')
            ->where('penjualan_id', $id)
            ->update([
                'user_id' => $request->user_id,
                'margin_penjualan_id' => $request->margin_penjualan_id,
                'subtotal_nilai' => $request->subtotal_nilai,
                'ppn' => $request->ppn,
                'total_nilai' => $totalNilai,
            ]);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('penjualan')->where('penjualan_id', $id)->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
