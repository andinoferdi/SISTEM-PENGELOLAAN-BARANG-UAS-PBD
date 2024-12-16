# Sistem Pengelolaan Barang dengan Laravel

Aplikasi ini adalah sistem pengelolaan data barang berbasis web yang dikembangkan menggunakan framework Laravel. Aplikasi ini dirancang untuk mendukung pengelolaan pengadaan, penerimaan, penjualan, retur, dan kartu stok barang.

## Fitur Utama

1. **Pengadaan Barang**

    - Tambah pengadaan barang dari vendor.
    - Kelola data pengadaan seperti jumlah barang dan total nilai pengadaan.

2. **Penerimaan Barang**

    - Mencatat penerimaan barang berdasarkan pengadaan.
    - Validasi jumlah barang yang diterima tidak melebihi jumlah pengadaan.

3. **Penjualan Barang**

    - Mencatat transaksi penjualan barang.
    - Pengurangan otomatis stok barang berdasarkan jumlah penjualan.

4. **Retur Barang**

    - Mencatat barang yang diretur.
    - Penyesuaian otomatis stok barang berdasarkan retur.

5. **Kartu Stok**
    - Melihat riwayat pergerakan stok barang secara rinci.
    - Menampilkan jenis transaksi, jumlah masuk, keluar, dan saldo akhir barang.

## Teknologi yang Digunakan

-   **Framework**: Laravel
-   **Database**: MySQL
-   **Frontend**: Blade Template

## Penggunaan

### Pengadaan Barang

1. Masuk ke menu **Pengadaan Barang**.
2. Klik **Tambah Pengadaan** dan isi detail pengadaan.
3. Simpan pengadaan untuk mencatat transaksi.

### Penerimaan Barang

1. Masuk ke menu **Penerimaan Barang**.
2. Pilih pengadaan yang sesuai dan masukkan jumlah barang yang diterima.
3. Pastikan jumlah barang yang diterima tidak melebihi jumlah pengadaan.

### Penjualan Barang

1. Masuk ke menu **Penjualan Barang**.
2. Pilih barang yang akan dijual dan masukkan jumlahnya.
3. Sistem akan otomatis mengurangi stok barang.

### Retur Barang

1. Masuk ke menu **Retur Barang**.
2. Pilih barang yang akan diretur dan masukkan jumlahnya.
3. Sistem akan otomatis memperbarui stok barang.

### Kartu Stok

1. Masuk ke menu **Kartu Stok**.
2. Lihat riwayat pergerakan stok barang.
3. Data yang ditampilkan meliputi transaksi masuk, keluar, dan saldo akhir.

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan kirimkan pull request ke repositori.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
