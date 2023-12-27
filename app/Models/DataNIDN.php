<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNIDN extends Model
{
    use HasFactory;

    protected $table = 'datas_nidn_dosen';

    protected $fillable = [
        'NIDN_NIK'
    ];

    public $timestamps = false;
}
