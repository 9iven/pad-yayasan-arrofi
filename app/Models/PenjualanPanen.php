<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanPanen extends Model
{
    use HasFactory, SoftDeletes;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'penjualan_panen';

    protected $fillable = [
        'jenis_tanaman',
        'tanggal_jual',
        'kuantitas',
        'satuan',
        'harga_satuan',
        'total_harga',
        'pembeli',
        'bukti_foto',
        'keterangan',
        'user_id',
        'deleted_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}