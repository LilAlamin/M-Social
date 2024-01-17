<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = ['id_user','username','email','password','user_type'];
}
