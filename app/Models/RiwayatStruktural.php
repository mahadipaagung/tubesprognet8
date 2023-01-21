<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatStruktural extends Model
{
    use HasFactory;
    protected $table='t_riwayat_struktural';
    protected $primaryKey = 'riwayat_struktural_id';

    protected $fillable = [
        'riwayat_struktural_id',
        'pegawai_id',
        'jabatan_struktural_id',
        'unit_id',
        'sub_unit_id',
        'no_sk_diangkat',
        'tmt_sk_diangkat',
        'tgl_sk_diangkat',
        'no_sk_berhenti',
        'tmt_sk_berhenti',
        'tgl_sk_berhenti',
        'nama_penanda_tangan_pengangkat',
        'jabatan_penanda_tangan_pengangkat',
        'nip_penanda_tangan_pengangkat',
        'nama_penanda_tangan_berhenti',
        'jabatan_penanda_tangan_berhenti',
        'nip_penanda_tangan_berhenti',
        'keterangan',
        'status_data_valid',
        'file_sk_diangkat',
        'file_sk_berhenti',
        'status_file_valid',
        'keterangan_validasi',
        'is_aktif',
        'flag_terakhir',
        'created_by',
        'updated_by'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function sub_unit(): BelongsTo
    {
        return $this->belongsTo(SubUnit::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(JabatanStruktural::class, 'jabatan_struktural_id', 'jabatan_id');
    }
}
