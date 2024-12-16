@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Edit</strong> Margin Penjualan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('margin_penjualan.update', $marginPenjualan->margin_penjualan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="persen" class="form-label">Persen Margin Penjualan</label>
                        <input type="number" name="persen" class="form-control @error('persen') is-invalid @enderror"
                            value="{{ $marginPenjualan->persen }}" required min="0" autocomplete="off"
                            max="100">
                        @error('persen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="1" {{ $marginPenjualan->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $marginPenjualan->status == 0 ? 'selected' : '' }}>Tidak Aktif
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                            @foreach ($users as $user)
                                @if (auth()->user()->role_id == 1 || auth()->user()->user_id == $user->user_id)
                                    <option value="{{ $user->user_id }}"
                                        {{ $user->user_id == $marginPenjualan->user_id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
