@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Kartu Stok</strong></h1>
                </div>
            </div>

            <div class="card-body pt-0">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis Transaksi</th>
                            <th>Stok Masuk</th>
                            <th>Stok Keluar</th>
                            <th>Stok Akhir</th>
                            <th>Stok Terkini</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($kartuStok as $kartu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kartu->nama_barang }}</td>
                                <td>
                                    @if ($kartu->jenis_transaksi == 'O')
                                        Penerimaan
                                    @elseif ($kartu->jenis_transaksi == 'P')
                                        Pengadaan
                                    @elseif ($kartu->jenis_transaksi == 'S')
                                        Penjualan
                                    @elseif ($kartu->jenis_transaksi == 'R')
                                        Retur
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>{{ $kartu->masuk }}</td>
                                <td>{{ $kartu->keluar }}</td>
                                <td>{{ $kartu->stock }}</td>
                                <td>
                                    @php
                                        $currentStock = DB::selectOne('SELECT get_current_stock(?) AS current_stock', [
                                            $kartu->kartu_barang_id,
                                        ]);
                                    @endphp
                                    {{ $currentStock->current_stock ?? '0' }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($kartu->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <form action="{{ route('kartu_stok.destroy', $kartu->kartu_stok_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
