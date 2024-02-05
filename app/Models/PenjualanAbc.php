<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanAbc extends Model
{
    use HasFactory;

    protected $table = 'penjualan_abc';
    protected $primaryKey = 'id_penjualan';
    protected $guarded = [];

    public function member_abc()
    {
        return $this->hasOne(MemberAbc::class, 'id_member', 'id_member');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
