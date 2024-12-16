<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KartuStokController extends Controller
{
    public function index()
    {
        $kartuStok = DB::table('v_kartu_stok')->get();
        return view('dashboard.kartu_stok.index', compact('kartuStok'));
    }

  
    public function destroy($id)
    {
        DB::table('kartu_stok')
            ->where('kartu_stok_id', $id)
            ->delete();
    
        return redirect()->route('kartu_stok.index')->with('success', 'Kartu Stok berhasil dihapus!');
    }
    
    

    public function getCurrentStock($barangId)
    {
        try {
            $currentStock = DB::selectOne('SELECT get_current_stock(?) AS current_stock', [$barangId]);

            if ($currentStock) {
                return response()->json([
                    'status' => 'success',
                    'current_stock' => $currentStock->current_stock
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Stok tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil stok.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
