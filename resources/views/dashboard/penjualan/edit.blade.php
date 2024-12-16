@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h1 class="h3"><strong>Edit</strong> Penjualan</h1>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('penjualan.update', $penjualan->penjualan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-select" required>
                            @foreach ($users as $user)
                                @if (auth()->user()->role_id == 1 || auth()->user()->user_id == $user->user_id)
                                    <option value="{{ $user->user_id }}"
                                        {{ $user->user_id == $penjualan->user_id ? 'selected' : '' }}>
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
                        <label for="margin_penjualan_id" class="form-label">Margin Penjualan</label>
                        <select name="margin_penjualan_id" class="form-select" required>
                            @foreach ($margin_penjualan as $margin)
                                @if ($margin->status == 1)
                                    <option value="{{ $margin->margin_penjualan_id }}"
                                        {{ $margin->margin_penjualan_id == $penjualan->margin_penjualan_id ? 'selected' : '' }}>
                                        {{ $margin->persen }}%
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('margin_penjualan_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtotal_nilai" class="form-label">Subtotal Nilai</label>
                        <input type="number" name="subtotal_nilai" class="form-control"
                            value="{{ $penjualan->subtotal_nilai }}" required autocomplete="off">
                        @error('subtotal_nilai')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ppn" class="form-label">PPN (%)</label>
                        <input type="number" name="ppn" class="form-control" value="{{ $penjualan->ppn }}" required
                            autocomplete="off">
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
