<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaKeluargaRequest;
use App\Models\Agama;
use App\Models\AnggotaKeluarga;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Pegawai;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AnggotaKeluargaController extends Controller
{
    // protected $pegawai_id;

    public function index($id)
    {
        $nama_pegawai = Pegawai::select('nama')->find($id);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Anggota Keluarga ';
        $table_id = 'anggota_keluarga';
        $nama   = $nama_pegawai->nama;


        return view('AnggotaKeluarga.index', compact('subtitle', 'table_id', 'icon', 'id', 'nama'));
    }

    public function list(Request $request)
    {
        $data = AnggotaKeluarga::where('pegawai_id', $request->id)->get();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/pegawai/keluarga/".$data->id_anggota_keluarga."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>  ";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id_anggota_keluarga}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id_anggota_keluarga}' data-nim='{$data->nim}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a>   ";
                    $aksi .= "<a title='Show Data' href='/pegawai/keluarga/show/".$data->id_anggota_keluarga."' class='btn btn-md btn-info' data-id='{$data->id_anggota_keluarga}' ><i class='ti-info' data-toggle='tooltip' data-placement='bottom' ></i></a>   ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function create($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Keluarga';

        $agama = Agama::get();
        $pendidikan = Pendidikan::get();
        $pekerjaan = Pekerjaan::get();
        $golongan_darah = GolonganDarah::get();
        $jenis_kelamin = JenisKelamin::get();
        // dd($jenis_kelamin);

        return view('AnggotaKeluarga.create', compact('subtitle', 'icon', 'id'), [
            'agama' => $agama,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'golongan_darah' => $golongan_darah,
            'jenis_kelamin' => $jenis_kelamin,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nik'           => 'required|unique:m_anggota_keluarga,nik',
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required',
            'keterangan'    => 'required',
        ]);
        $request['created_by'] = 1;
        $filename = null;
        $filename2=null;

        if ($request->file_foto) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_foto')->getClientOriginalName());
            $request->file('file_foto')->move(public_path('keluarga'), $filename);
        }

        if ($request->file_akta_meninggal) {
            $filename2 = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_akta_meninggal')->getClientOriginalName());
            $request->file('file_akta_meninggal')->move(public_path('keluarga'), $filename2);
        }

        $input = $request->all();
        $input['file_foto'] = $filename;
        $input['file_akta_meninggal'] = $filename2;

        AnggotaKeluarga::create($input);
        return redirect()->route('keluarga.index', ['id'=>$request->pegawai_id]);
    }

    public function delete($id_anggota_keluarga)
    {
        if (AnggotaKeluarga::destroy($id_anggota_keluarga)) {
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function edit($id_anggota_keluarga)
    {
        $data = AnggotaKeluarga::find($id_anggota_keluarga);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Keluarga';

        // dd($data->jenis_kelamin->nama);
        $agama = Agama::get();
        $pendidikan = Pendidikan::get();
        $pekerjaan = Pekerjaan::get();
        $golongan_darah = GolonganDarah::get();
        $jenis_kelamin = JenisKelamin::get();

        return view('AnggotaKeluarga.edit', compact('subtitle', 'icon', 'data'), [
            'agama' => $agama,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'golongan_darah' => $golongan_darah,
            'jenis_kelamin' => $jenis_kelamin,
        ]);
    }

    public function update(Request $request, $anggota_keluarga)
    {
        $filename = null;
        $filename2=null;

        if ($request->file_foto) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_foto')->getClientOriginalName());
            $request->file('file_foto')->move(public_path('keluarga'), $filename);
        }

        if ($request->file_akta_meninggal) {
            $filename2 = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_akta_meninggal')->getClientOriginalName());
            $request->file('file_akta_meninggal')->move(public_path('keluarga'), $filename2);
        }

        $input = $request->all();
        $input['file_foto'] = $filename;
        $input['file_akta_meninggal'] = $filename2;
        AnggotaKeluarga::find($anggota_keluarga)->update($input);
        return redirect()->route('keluarga.index', ['id'=>$request->pegawai_id]);
    }

    public function show(AnggotaKeluarga $id)
    {
        $data = $id;
        $nama_pegawai = Pegawai::select('nama')->find($id->pegawai_id);
        // dd($nama_pegawai);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Anggota Keluarga ';
        $table_id = 'anggota_keluarga';
        $nama   = $nama_pegawai->nama;

        return view('AnggotaKeluarga.show', compact('subtitle', 'table_id', 'icon', 'data', 'nama'));
    }
}
