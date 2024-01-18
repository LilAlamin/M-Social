<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;

    protected $table = "file";
    protected $primaryKey = "id_file";
    protected $fillable = ["id_file", "id_pengajuan", "nama_file"];

    protected function pengajuan() {
        return $this->belongsTo(pengaduan::class, 'id_pengajuan');
    }
}
