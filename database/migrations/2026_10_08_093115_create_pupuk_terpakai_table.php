<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pupuk_terpakai', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pakai');
            $table->string('nama_pupuk');
            $table->string('satuan');
            $table->decimal('kuantitas', 10, 2);
            $table->string('lahan_blok');
            $table->text('tujuan_pakai');
            $table->string('bukti_foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupuk_terpakai');
    }
};
