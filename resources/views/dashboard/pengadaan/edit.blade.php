@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Edit</strong> Pengadaan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('pengadaan.update', $pengadaan->pengadaan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            @foreach ($users as $user)
                                @if (auth()->user()->role_id == 1 || auth()->user()->user_id == $user->user_id)
                                    <option value="{{ $user->user_id }}"
                                        {{ $user->user_id == $pengadaan->user_id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="vendor_id" class="form-label">Vendor</label>
                        <select name="vendor_id" class="form-select @error('vendor_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih vendor</option>
                            @foreach ($vendor as $v)
                                @if ($v->status == 1)
                                    <option value="{{ $v->vendor_id }}"
                                        {{ $v->vendor_id == $pengadaan->vendor_id ? 'selected' : '' }}>
                                        {{ $v->nama_vendor }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('vendor_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtotal_nilai" class="form-label">Subtotal Nilai</label>
                        <input type="number" name="subtotal_nilai"
                            class="form-control @error('subtotal_nilai') is-invalid @enderror"
                            value="{{ $pengadaan->subtotal_nilai }}" required>
                        @error('subtotal_nilai')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ppn" class="form-label">PPN (%)</label>
                        <input type="number" name="ppn" class="form-control @error('ppn') is-invalid @enderror"
                            value="{{ $pengadaan->ppn }}" placeholder="Masukkan persentase PPN (contoh: 10)" required>
                        @error('ppn')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
