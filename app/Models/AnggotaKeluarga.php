<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggotaKeluarga extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='m_anggota_keluarga';

    protected $primaryKey = 'id_anggota_keluarga';

    protected $fillable = [
        'id_anggota_keluarga',
        'pegawai_id',
        'agama_id',
        'jenjang_pendidikan_id',
        'pekerjaan_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'alamat',
        'hubungan',
        'file_foto',
        'golongan_darah_id',
        'is_anak_kandung',
        'is_balimed',
        'is_valid',
        'keterangan',
        'jenis_kelamin_id',
        'akta_meninggal',
        'tgl_meninggal',
        'file_akta_meninggal',
        'created_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function agama(): BelongsTo
    {
        return $this->belongsTo(Agama::class);
    }

    public function pendidikan(): BelongsTo
    {
        return $this->belongsTo(Pendidikan::class, 'jenjang_pendidikan_id', 'id');
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'id');
    }

    public function golongan_darah(): BelongsTo
    {
        return $this->belongsTo(GolonganDarah::class);
    }

    public function jenis_kelamin(): BelongsTo
    {
        return $this->belongsTo(JenisKelamin::class);
    }
}
