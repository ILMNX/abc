<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetailAbc extends Model
{
    use HasFactory;

    protected $table = 'pembelian_detail_abc';
    protected $primaryKey = 'id_pembelian_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->hasOne(ProdukAbc::class, 'id_produk', 'id_produk');
    }
}
