@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Detail Retur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('detail_retur.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="retur_id" class="form-label">Retur</label>
                        <select name="retur_id" class="form-control @error('retur_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Retur Id</option>
                            @foreach ($retur as $retur)
                                <option value="{{ $retur->retur_id }}">Retur Id: {{ $retur->retur_id }}</option>
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
                            <option value="" disabled selected>Pilih Detail Penerimaan</option>
                            @foreach ($detailPenerimaan as $detailpenerimaan)
                                <option value="{{ $detailpenerimaan->detail_penerimaan_id }}">Detail Penerimaan Id :
                                    {{ $detailpenerimaan->detail_penerimaan_id }} - {{ $detailpenerimaan->nama_barang }}
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
                            value="{{ old('jumlah') }}" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="4" required>{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('detail_retur.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
