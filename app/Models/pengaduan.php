<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaduan extends Model
{
    use HasFactory;

    protected $table = "pengaduan";
    protected $primaryKey = "id_pengaduan";
    protected $fillable = ["id_pengaduan", "id_user", "judul_pengaduan", "lokasi_pengaduan", "deskripsi_pengaduan"];



    public function user(){
        return $this->belongsTo(users::class, 'id_user'); 
    }

    public function files()
    {
        return $this->hasMany(file::class, 'id_pengaduan');
    }
}
