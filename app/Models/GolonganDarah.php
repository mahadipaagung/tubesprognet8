<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GolonganDarah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'm_golongan_darah';
}
