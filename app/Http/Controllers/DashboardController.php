<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $barangCount = DB::table('barang')->count();
        $vendorCount = DB::table('vendor')->count();
        $userCount = DB::table('user')->count();
        $pengadaanCount = DB::table('pengadaan')->count();
        $penerimaanCount = DB::table('penerimaan')->count();
        $returCount = DB::table('retur')->count();
        $penjualanCount = DB::table('penjualan')->count();
        $detailPenerimaanCount = DB::table('detail_penerimaan')->count();
        $detailPengadaanCount = DB::table('detail_pengadaan')->count();
        $detailPenjualanCount = DB::table('detail_penjualan')->count();
        $detailReturCount = DB::table('detail_retur')->count();
        $kartuStokCount = DB::table('v_kartu_stok')->count();

        $marginPenjualanCount = DB::table('margin_penjualan')->count();
        $roleCount = DB::table('role')->count();
        $satuanCount = DB::table('satuan')->count();

        $penjualanData = DB::table('penjualan')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_nilai) as total'))
            ->groupBy('month')
            ->get();

            

        return view('dashboard.index', compact(
            'barangCount', 'vendorCount', 'userCount', 
            'pengadaanCount', 'penerimaanCount', 'returCount', 
            'penjualanCount', 'detailPenerimaanCount', 
            'detailPengadaanCount', 'detailPenjualanCount', 
            'detailReturCount', 'kartuStokCount', 'penjualanData',
            'marginPenjualanCount', 'roleCount', 'satuanCount'
        ));
    }
}
