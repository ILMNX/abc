<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAbc extends Model
{
    use HasFactory;

    protected $table = 'produk_abc';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];
}
