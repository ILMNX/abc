<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianAbc extends Model
{
    use HasFactory;

    protected $table = 'pembelian_abc';
    protected $primaryKey = 'id_pembelian';
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(SupplierAbc::class, 'id_supplier', 'id_supplier');
    }
}
