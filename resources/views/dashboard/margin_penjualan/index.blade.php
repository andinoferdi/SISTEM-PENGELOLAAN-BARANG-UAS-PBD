@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h1 class="h3"><strong>Master</strong> Margin Penjualan</h1>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('margin_penjualan.create') }}" class="btn btn-primary">Tambah Margin Penjualan</a>
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
                            <th>Persen</th>
                            <th>Status</th>
                            <th>User</th>
                            <th class="min-w-100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($marginPenjualan as $margin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $margin->persen }}%</td>
                                <td>
                                    <span class="{{ $margin->status == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $margin->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>

                                <td>{{ $margin->username }}</td>
                                <td>
                                    <a href="{{ route('margin_penjualan.edit', $margin->margin_penjualan_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('margin_penjualan.destroy', $margin->margin_penjualan_id) }}"
                                        method="POST" style="display:inline-block;">
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
