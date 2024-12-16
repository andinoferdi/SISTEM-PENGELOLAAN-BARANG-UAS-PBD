@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Detail Retur</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('detail_retur.create') }}" class="btn btn-primary">Tambah Detail Retur</a>
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
                            <th>Jumlah</th>
                            <th>Alasan</th>
                            <th>Retur ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($detailRetur as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>{{ $detail->alasan }}</td>
                                <td>{{ $detail->retur_id }}</td>
                                <td>
                                    <a href="{{ route('detail_retur.edit', $detail->detail_retur_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('detail_retur.destroy', $detail->detail_retur_id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data detail retur.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
