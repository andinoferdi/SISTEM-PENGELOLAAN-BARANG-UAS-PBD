@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Pengadaan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('pengadaan.create') }}" class="btn btn-primary">Tambah Pengadaan</a>

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
                            <th>Nama Vendor</th>
                            <th>Total Nilai</th>
                            <th>Status</th>
                            <th class="min-w-100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($pengadaan as $pengadaan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengadaan->nama_vendor }}</td>
                                <td>{{ number_format($pengadaan->total_nilai, 0, ',', '.') }}</td>
                                <td class="{{ $pengadaan->status == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $pengadaan->status == 0 ? 'Belum diterima' : 'Diterima' }}
                                </td>
                                <td>
                                    <a href="{{ route('pengadaan.edit', $pengadaan->pengadaan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pengadaan.destroy', $pengadaan->pengadaan_id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-toolbar">
                    <a href="{{ route('detail_pengadaan.index') }}" class="btn btn-info">Lihat Detail Pengadaan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
