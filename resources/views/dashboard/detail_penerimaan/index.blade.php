@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Detail Penerimaan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('detail_penerimaan.create') }}" class="btn btn-primary">Tambah Detail Penerimaan</a>
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
                            <th>Harga Satuan Terima</th>
                            <th>Jumlah Terima</th>
                            <th>Subtotal Terima</th>
                            <th>Penerimaan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($detailPenerimaan as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ number_format($detail->harga_satuan_terima, 0, ',', '.') }}</td>
                                <td>{{ $detail->jumlah_terima }}</td>
                                <td>{{ number_format($detail->subtotal_terima, 0, ',', '.') }}</td>
                                <td>{{ $detail->penerimaan_id }}</td>
                                <td>
                                    <a href="{{ route('detail_penerimaan.edit', $detail->detail_penerimaan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('detail_penerimaan.destroy', $detail->detail_penerimaan_id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data detail penerimaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
