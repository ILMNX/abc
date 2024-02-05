<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranAbc extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_abc';
    protected $primaryKey = 'id_pengeluaran';
    protected $guarded = [];
}
