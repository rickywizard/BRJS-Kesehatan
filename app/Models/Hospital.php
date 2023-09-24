<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    public function city() {
        return $this->belongsTo(City::class, 'id_kota', 'id_kota');
    }

    protected $primaryKey = 'id_hospital';
}
