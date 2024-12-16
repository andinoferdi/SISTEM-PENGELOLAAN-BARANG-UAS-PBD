@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Penerimaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('penerimaan.update', $penerimaan->penerimaan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="pengadaan_id" class="form-label">Pengadaan ID</label>
                        <select name="pengadaan_id" class="form-control @error('pengadaan_id') is-invalid @enderror"
                            required>
                            <option value="" disabled>Pilih Pengadaan</option>
                            @foreach ($pengadaan as $pengadaan)
                                @if ($pengadaan->status == 0)
                                    <option value="{{ $pengadaan->pengadaan_id }}"
                                        {{ $pengadaan->pengadaan_id == $penerimaan->pengadaan_id ? 'selected' : '' }}>
                                        Pengadaan ID: {{ $pengadaan->pengadaan_id }} - {{ $pengadaan->nama_vendor }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('pengadaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                            <option value="" disabled>Pilih User</option>
                            @foreach ($users as $user)
                                @if (auth()->user()->role_id == 1 || auth()->user()->user_id == $user->user_id)
                                    <option value="{{ $user->user_id }}"
                                        {{ $user->user_id == $penerimaan->user_id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
