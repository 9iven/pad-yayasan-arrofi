<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KepentinganUmum;
use App\Models\PenjualanPanen;
use App\Models\PerawatanLahan;
use App\Models\PupukMasuk;
use App\Models\PupukTerpakai;
use App\Models\User;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_super_admin', false)->first() ?? User::first();

        PenjualanPanen::create([
            'jenis_tanaman' => 'Pepaya Kalifornia',
            'tanggal_jual' => '2026-03-01',
            'kuantitas' => 1500.00,
            'satuan' => 'kg',
            'harga_satuan' => 8000.00,
            'total_harga' => 12000000.00,
            'pembeli' => 'PT Buah Segar Nusantara',
            'bukti_foto' => null,
            'keterangan' => 'Penjualan panen raya blok A',
            'user_id' => $admin->id,
        ]);

        PerawatanLahan::create([
            'tanggal' => '2026-03-05',
            'kategori_biaya' => 'Pembersihan Gulma',
            'deskripsi' => 'Pengolahan dan pembersihan rumput liar di Blok B',
            'biaya' => 750000.00,
            'bukti_foto' => null,
            'keterangan' => 'Biaya harian 3 pekerja',
            'user_id' => $admin->id,
        ]);

        KepentinganUmum::create([
            'tanggal' => '2026-03-10',
            'kategori_kegiatan' => 'Bantuan Warga',
            'deskripsi' => 'Penyaluran sembako untuk masyarakat sekitar lahan',
            'jumlah' => 2500000.00,
            'bukti_foto' => null,
            'tampil_di_landing' => true,
            'keterangan' => 'Program CSR Yayasan Arrofi\'i',
            'user_id' => $admin->id,
        ]);

        PupukMasuk::create([
            'tanggal' => '2026-02-20',
            'nama_pupuk' => 'NPK Mutiara 16-16-16',
            'satuan' => 'karung',
            'kuantitas' => 20.00,
            'harga_satuan' => 550000.00,
            'total_harga' => 11000000.00,
            'supplier' => 'Toko Tani Makmur',
            'bukti_foto' => null,
            'keterangan' => 'Pengadaan stok pupuk kuartal I',
            'user_id' => $admin->id,
        ]);

        PupukTerpakai::create([
            'tanggal_pakai' => '2026-02-25',
            'nama_pupuk' => 'NPK Mutiara 16-16-16',
            'satuan' => 'karung',
            'kuantitas' => 5.00,
            'lahan_blok' => 'Blok A',
            'tujuan_pakai' => 'Pemupukan rutin tanaman pepaya usia 6 bulan',
            'bukti_foto' => null,
            'keterangan' => 'Pemupukan tahap 2',
            'user_id' => $admin->id,
        ]);
    }
}