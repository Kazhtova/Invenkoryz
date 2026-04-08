<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeStokOpname extends Model
{
    protected $guarded = ['id'];
    public function items(){
        return $this->hasMany(ItemStokOpname::class, 'periode_stok_opname_id', 'id');
    }
}