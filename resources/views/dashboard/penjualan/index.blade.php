@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Penjualan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah Penjualan</a>
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
                            <th>User</th>
                            <th>Margin Penjualan</th>
                            <th>PPN</th>
                            <th>Total Nilai</th>
                            <th class="min-w-100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($penjualan as $penjualan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penjualan->username }}</td>
                                <td>{{ $penjualan->persen }} %</td>
                                <td>{{ $penjualan->ppn }} %</td>
                                <td>{{ number_format($penjualan->total_nilai, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('penjualan.edit', $penjualan->penjualan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('penjualan.destroy', $penjualan->penjualan_id) }}" method="POST"
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
                    <a href="{{ route('detail_penjualan.index') }}" class="btn btn-info">Lihat Detail Penjualan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
