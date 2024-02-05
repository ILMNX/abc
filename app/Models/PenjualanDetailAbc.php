<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetailAbc extends Model
{
    use HasFactory;

    protected $table = 'penjualan_detail_abc';
    protected $primaryKey = 'id_penjualan_detail';
    protected $guarded = [];

    public function produk_abc()
    {
        return $this->hasOne(ProdukAbc::class, 'id_produk', 'id_produk');
    }
}
