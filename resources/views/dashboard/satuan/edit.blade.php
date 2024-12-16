@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Edit</strong> Satuan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('satuan.update', $satuan->satuan_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_satuan" class="form-label">Nama Satuan</label>
                        <input type="text" name="nama_satuan" class="form-control" value="{{ $satuan->nama_satuan }}"
                            required autocomplete="off">
                        @error('nama_satuan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $satuan->status == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $satuan->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
