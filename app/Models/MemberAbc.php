<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAbc extends Model
{
    use HasFactory;

    protected $table = 'member_abc';
    protected $primaryKey = 'id_member';
    protected $guarded = [];
}
