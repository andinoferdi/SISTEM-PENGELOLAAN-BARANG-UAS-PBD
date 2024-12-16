@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Retur</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('retur.create') }}" class="btn btn-primary">Tambah Retur</a>
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
                            <th>User</th>
                            <th>Penerimaan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($retur as $retur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $retur->username }}</td>
                                <td>{{ $retur->penerimaan_id }} - {{ $retur->nama_vendor }}</td>
                                <td>
                                    <a href="{{ route('retur.edit', $retur->retur_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('retur.destroy', $retur->retur_id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data retur.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-toolbar">
                    <a href="{{ route('detail_retur.index') }}" class="btn btn-info">Lihat Detail Retur</a>
                </div>
            </div>
        </div>
    </div>
@endsection
