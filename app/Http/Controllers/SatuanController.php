<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SatuanController extends Controller
{

    public function index()
    {
        $satuan = DB::table('satuan')->get();
        return view('dashboard.satuan.index', compact('satuan'));
    }

    public function create()
    {
        return view('dashboard.satuan.create');
    }

    public function edit($id)
    {
        $satuan = DB::table('satuan')->where('satuan_id', $id)->first();

        if (!$satuan) {
            abort(404, 'Data satuan tidak ditemukan.');
        }

        return view('dashboard.satuan.edit', compact('satuan'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_satuan' => 'required|string|max:255',
        'status' => 'required|integer',
    ]);

    DB::select('CALL InsertSatuan(?, ?)', [
        $request->nama_satuan,
        $request->status 
    ]);

    return redirect()->route('satuan.index')->with('success', 'Satuan berhasil ditambahkan!');
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:255',
            'status' => 'required',
        ]);

        DB::table('satuan')
            ->where('satuan_id', $id)
            ->update([
                'nama_satuan' => $request->input('nama_satuan'),
                'status' => $request->input('status'),

            ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('satuan')
            ->where('satuan_id', $id)
            ->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus!');
    }
}
