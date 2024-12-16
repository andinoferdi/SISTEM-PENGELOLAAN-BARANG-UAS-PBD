@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Penerimaan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('penerimaan.create') }}" class="btn btn-primary">Tambah Penerimaan</a>
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
                            <th>Pengadaan ID</th>
                            <th>Nama Vendor</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($penerimaan as $penerimaan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penerimaan->pengadaan_id }}</td>
                                <td>{{ $penerimaan->nama_vendor }}</td>
                                <td>{{ $penerimaan->username }}</td>
                                <td>
                                    <a href="{{ route('penerimaan.edit', $penerimaan->penerimaan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('penerimaan.destroy', $penerimaan->penerimaan_id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data penerimaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-toolbar">
                    <a href="{{ route('detail_penerimaan.index') }}" class="btn btn-info">Lihat Detail Penerimaan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
