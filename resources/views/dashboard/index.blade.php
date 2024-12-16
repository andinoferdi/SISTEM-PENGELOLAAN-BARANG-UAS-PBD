@extends('dashboard.layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Barang</h6>
                            <h4 class="font-weight-bold">{{ $barangCount }}</h4>
                        </div>
                        <i class="fas fa-box fa-2x text-primary"></i>
                    </div>
                    <a href="{{ route('barang.index') }}" class="card-footer text-primary text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Vendor</h6>
                            <h4 class="font-weight-bold">{{ $vendorCount }}</h4>
                        </div>
                        <i class="fas fa-store fa-2x text-success"></i>
                    </div>
                    <a href="{{ route('vendor.index') }}" class="card-footer text-success text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total User</h6>
                            <h4 class="font-weight-bold">{{ $userCount }}</h4>
                        </div>
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                    <a href="{{ route('user.index') }}" class="card-footer text-info text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Pengadaan</h6>
                            <h4 class="font-weight-bold">{{ $pengadaanCount }}</h4>
                        </div>
                        <i class="fas fa-clipboard-list fa-2x text-warning"></i>
                    </div>
                    <a href="{{ route('pengadaan.index') }}" class="card-footer text-warning text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Detail Penerimaan</h6>
                            <h4 class="font-weight-bold">{{ $detailPenerimaanCount }}</h4>
                        </div>
                        <i class="fas fa-clipboard-check fa-2x text-info"></i>
                    </div>
                    <a href="{{ route('detail_penerimaan.index') }}" class="card-footer text-info text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Detail Retur</h6>
                            <h4 class="font-weight-bold">{{ $detailReturCount }}</h4>
                        </div>
                        <i class="fas fa-arrow-left fa-2x text-danger"></i>
                    </div>
                    <a href="{{ route('detail_retur.index') }}" class="card-footer text-danger text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Detail Pengadaan</h6>
                            <h4 class="font-weight-bold">{{ $detailPengadaanCount }}</h4>
                        </div>
                        <i class="fas fa-boxes fa-2x text-success"></i>
                    </div>
                    <a href="{{ route('detail_pengadaan.index') }}" class="card-footer text-success text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Kartu Stok</h6>
                            <h4 class="font-weight-bold">{{ $kartuStokCount }}</h4>
                        </div>
                        <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                    </div>
                    <a href="{{ route('kartu-stok.index') }}" class="card-footer text-primary text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Role</h6>
                            <h4 class="font-weight-bold">{{ $roleCount }}</h4>
                        </div>
                        <i class="fas fa-user-shield fa-2x text-warning"></i>
                    </div>
                    <a href="{{ route('role.index') }}" class="card-footer text-warning text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Satuan</h6>
                            <h4 class="font-weight-bold">{{ $satuanCount }}</h4>
                        </div>
                        <i class="fas fa-weight-hanging fa-2x text-success"></i>
                    </div>
                    <a href="{{ route('satuan.index') }}" class="card-footer text-success text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Margin Penjualan</h6>
                            <h4 class="font-weight-bold">{{ $marginPenjualanCount }}</h4>
                        </div>
                        <i class="fas fa-percent fa-2x text-info"></i>
                    </div>
                    <a href="{{ route('margin_penjualan.index') }}" class="card-footer text-info text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="text-center mb-0 mt-7">Grafik Penjualan Bulanan</h5>
                    </div>

                    <div class="card-body">
                        <canvas id="penjualanChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="text-center mb-0 mt-7">Grafik Penerimaan dan Retur</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="penerimaanReturChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const penjualanData = {!! json_encode($penjualanData) !!};
        const penjualanLabels = penjualanData.map(data => `Bulan ${data.month}`);
        const penjualanValues = penjualanData.map(data => data.total);

        new Chart(document.getElementById('penjualanChart'), {
            type: 'bar',
            data: {
                labels: penjualanLabels,
                datasets: [{
                    label: 'Total Penjualan',
                    data: penjualanValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });


        const penerimaanCount = {{ $penerimaanCount }};
        const returCount = {{ $returCount }};

        new Chart(document.getElementById('penerimaanReturChart'), {
            type: 'doughnut',
            data: {
                labels: ['Penerimaan', 'Retur'],
                datasets: [{
                    label: 'Jumlah',
                    data: [penerimaanCount, returCount],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderColor: ['#28a745', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
@endsection
