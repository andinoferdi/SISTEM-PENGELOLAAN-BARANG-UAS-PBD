@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Detail Retur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('detail_retur.update', $detailRetur->detail_retur_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="retur_id" class="form-label">Retur</label>
                        <select name="retur_id" class="form-control @error('retur_id') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Retur</option>
                            @foreach ($retur as $retur)
                                <option value="{{ $retur->retur_id }}"
                                    {{ $retur->retur_id == $detailRetur->retur_id ? 'selected' : '' }}>
                                    Retur Id: {{ $retur->retur_id }}
                                </option>
                            @endforeach
                        </select>
                        @error('retur_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="detail_penerimaan_id" class="form-label">Detail Penerimaan</label>
                        <select name="detail_penerimaan_id"
                            class="form-control @error('detail_penerimaan_id') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Detail Penerimaan</option>
                            @foreach ($detailPenerimaan as $detailpenerimaan)
                                <option value="{{ $detailpenerimaan->detail_penerimaan_id }}"
                                    {{ $detailpenerimaan->detail_penerimaan_id == $detailRetur->detail_penerimaan_id ? 'selected' : '' }}>
                                    Detail Penerimaan Id: {{ $detailpenerimaan->detail_penerimaan_id }} -
                                    {{ $detailpenerimaan->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('detail_penerimaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ old('jumlah', $detailRetur->jumlah) }}" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="4" required>{{ old('alasan', $detailRetur->alasan) }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('detail_retur.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
