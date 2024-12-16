@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Vendor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.update', $vendor->vendor_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_vendor" class="form-label">Nama Vendor</label>
                        <input type="text" name="nama_vendor" class="form-control" value="{{ $vendor->nama_vendor }}"
                            required autocomplete="off">
                        @error('nama_vendor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="badan_hukum" class="form-label">Badan Hukum</label>
                        <select name="badan_hukum" class="form-control" required>
                            <option value="P" {{ $vendor->badan_hukum == 'P' ? 'selected' : '' }}>PT</option>
                            <option value="C" {{ $vendor->badan_hukum == 'C' ? 'selected' : '' }}>CV</option>
                        </select>
                        @error('badan_hukum')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $vendor->status == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $vendor->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
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
