<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatKeaktifan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='t_riwayat_keaktifan';

    protected $primaryKey = 'riwayat_keaktifan_id';

    protected $fillable = [
        'riwayat_keaktifan_id',
        'pegawai_id',
        'status_keaktifan_id',
        'no_sk',
        'tgl_sk',
        'tmt_sk',
        'nama_penanda_tangan',
        'nip_penanda_tangan',
        'file_riwayat_keaktifan',
        'keterangan',
        'm_unit',
        'm_subunit',
        'status_data_valid',
        'keterangan_validasi',
        'flag_terakhir',
        'created_by',
        'updated_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function keaktifan(): BelongsTo
    {
        return $this->belongsTo(StatusKeaktifan::class, 'status_keaktifan_id', 'status_keaktipan_id');
    }

    public function sub_unit(): BelongsTo
    {
        return $this->belongsTo(SubUnit::class, 'm_subunit', 'id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'm_unit', 'id');
    }
}
