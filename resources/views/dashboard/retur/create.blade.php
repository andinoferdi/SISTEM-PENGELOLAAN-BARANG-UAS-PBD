@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Retur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('retur.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih User</option>
                            @foreach ($user as $user)
                                @if (auth()->user()->role_id == 1 || auth()->user()->user_id == $user->user_id)
                                    <option value="{{ $user->user_id }}"
                                        {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penerimaan_id" class="form-label">Penerimaan ID</label>
                        <select name="penerimaan_id" class="form-control @error('penerimaan_id') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Pilih Penerimaan</option>
                            @foreach ($penerimaan as $penerimaan)
                                <option value="{{ $penerimaan->penerimaan_id }}"
                                    {{ old('penerimaan_id') == $penerimaan->penerimaan_id ? 'selected' : '' }}>
                                    Penerimaan Id: {{ $penerimaan->penerimaan_id }} - Vendor: {{ $penerimaan->nama_vendor }}
                                </option>
                            @endforeach
                        </select>
                        @error('penerimaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
