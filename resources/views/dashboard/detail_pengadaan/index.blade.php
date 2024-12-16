@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Detail Pengadaan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('detail_pengadaan.create') }}" class="btn btn-primary">Tambah Detail Pengadaan</a>
                </div>
            </div>

            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
                @elseif ($message = Session::get('error'))
                    <div class="alert alert-danger">{{ $message }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Pengadaan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($detailPengadaan as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                <td>{{ $detail->pengadaan_id }} - {{ $detail->nama_vendor }}</td>
                                <td>
                                    <a href="{{ route('detail_pengadaan.edit', $detail->detail_pengadaan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('detail_pengadaan.destroy', $detail->detail_pengadaan_id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data detail pengadaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
