<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PupukMasuk extends Model
{
    use HasFactory, SoftDeletes;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'pupuk_masuk';

    protected $fillable = [
        'tanggal',
        'nama_pupuk',
        'satuan',
        'kuantitas',
        'harga_satuan',
        'total_harga',
        'supplier',
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