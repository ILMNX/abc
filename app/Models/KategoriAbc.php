<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAbc extends Model
{
    use HasFactory;

    protected $table = 'kategori_abc';
    protected $primaryKey = 'id_kategori';
    protected $guarded = [];
}
