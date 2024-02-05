<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAbc extends Model
{
    use HasFactory;

    protected $table = 'supplier_abc';
    protected $primaryKey = 'id_supplier';
    protected $guarded = [];
}
