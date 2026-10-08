<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KepentinganUmum extends Model
{
    use HasFactory, SoftDeletes;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'kepentingan_umum';

    protected $fillable = [
        'tanggal',
        'kategori_kegiatan',
        'deskripsi',
        'jumlah',
        'bukti_foto',
        'tampil_di_landing',
        'keterangan',
        'user_id',
        'deleted_by',
    ];

    protected $casts = [
        'tampil_di_landing' => 'boolean',
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