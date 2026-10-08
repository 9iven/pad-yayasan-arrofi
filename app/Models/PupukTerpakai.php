<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PupukTerpakai extends Model
{
    use HasFactory, SoftDeletes;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'pupuk_terpakai';

    protected $fillable = [
        'tanggal_pakai',
        'nama_pupuk',
        'satuan',
        'kuantitas',
        'lahan_blok',
        'tujuan_pakai',
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