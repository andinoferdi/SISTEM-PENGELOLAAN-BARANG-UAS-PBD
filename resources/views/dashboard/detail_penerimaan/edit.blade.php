@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3>Edit Detail Penerimaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('detail_penerimaan.update', $detailPenerimaan->detail_penerimaan_id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Barang</option>
                            @foreach ($barang as $barang)
                                @if ($barang->status == 1)
                                    <option value="{{ $barang->barang_id }}"
                                        {{ $detailPenerimaan->barang_id == $barang->barang_id ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga_satuan_terima" class="form-label">Harga Satuan Terima</label>
                        <input type="number" name="harga_satuan_terima"
                            class="form-control @error('harga_satuan_terima') is-invalid @enderror"
                            value="{{ $detailPenerimaan->harga_satuan_terima }}" autocomplete="off" required>
                        @error('harga_satuan_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_terima" class="form-label">Jumlah Terima</label>
                        <input type="number" name="jumlah_terima"
                            class="form-control @error('jumlah_terima') is-invalid @enderror"
                            value="{{ $detailPenerimaan->jumlah_terima }}" autocomplete="off" required>
                        @error('jumlah_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penerimaan_id" class="form-label">Penerimaan ID</label>
                        <select name="penerimaan_id" class="form-control @error('penerimaan_id') is-invalid @enderror"
                            required>
                            <option value="" disabled>Pilih Penerimaan</option>
                            @foreach ($penerimaan as $penerimaan)
                                <option value="{{ $penerimaan->penerimaan_id }}"
                                    {{ $detailPenerimaan->penerimaan_id == $penerimaan->penerimaan_id ? 'selected' : '' }}>
                                    Penerimaan Id: {{ $penerimaan->penerimaan_id }}
                                </option>
                            @endforeach
                        </select>
                        @error('penerimaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
