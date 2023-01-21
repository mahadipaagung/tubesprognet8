<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKelamin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'm_jenis_kelamin';
}
