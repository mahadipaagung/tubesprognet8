<?php

namespace App\Http\Controllers;

use App\Models\JabatanStruktural;
use App\Models\Pegawai;
use App\Models\RiwayatStruktural;
use App\Models\SubUnit;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class RiwayatStrukturalController extends Controller
{
    public function index($id)
    {
        $nama_pegawai = Pegawai::select('nama')->find($id);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Struktural';
        $table_id = 'riwayat_struktural';
        $nama   = $nama_pegawai->nama;
        // $data = RiwayatStruktural::where('pegawai_id', 137)->get();
        // dd($data);

        return view('Struktural.index', compact('subtitle', 'table_id', 'icon', 'id', 'nama'));
    }

    public function list(Request $request)
    {
        $data = RiwayatStruktural::where('pegawai_id', $request->id)->get();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/pegawai/struktural/".$data->riwayat_struktural_id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>  ";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->riwayat_struktural_id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->riwayat_struktural_id}' data-nim='{$data->nim}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a>   ";
                    $aksi .= "<a title='Show Data' href='/pegawai/struktural/show/".$data->riwayat_struktural_id."' class='btn btn-md btn-info' data-id='{$data->riwayat_struktural_id}' ><i class='ti-info' data-toggle='tooltip' data-placement='bottom' ></i></a>   ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function delete($id)
    {
        if (RiwayatStruktural::destroy($id)) {
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Riwayat Struktural';

        $unit = Unit::get();
        $sub_unit = SubUnit::get();
        $jabatan  = JabatanStruktural::get();

        return view('Struktural.create', compact('subtitle', 'icon', 'id'), [
            'unit'  => $unit,
            'sub_unit'  => $sub_unit,
            'jabatan'   => $jabatan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);
        $request['created_by'] = 1;
        $filename = null;
        $filename2 = null;
        if ($request->file_sk_diangkat) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_sk_diangkat')->getClientOriginalName());
            $request->file('file_sk_diangkat')->move(public_path('struktural'), $filename);
        }

        if ($request->file_sk_berhenti) {
            $filename2 = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_sk_berhenti')->getClientOriginalName());
            $request->file('file_sk_berhenti')->move(public_path('struktural'), $filename2);
        }


        $input = $request->all();
        $input['file_sk_diangkat'] = $filename ;
        $input['file_sk_berhenti'] = $filename2;

        RiwayatStruktural::create($input);
        return redirect()->route('struktural.index', ['id'=>$request->pegawai_id]);
    }

    public function edit($id)
    {
        $data = RiwayatStruktural::find($id);
        // dd($data->unit->nama);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Struktural';

        // dd($data->jabatan);
        $unit = Unit::get();
        $sub_unit = SubUnit::get();
        $jabatan  = JabatanStruktural::get();

        return view('Struktural.edit', compact('subtitle', 'icon', 'id', 'data'), [
            'unit'  => $unit,
            'sub_unit'  => $sub_unit,
            'jabatan'   => $jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->unit_id);
        $filename = null;
        $filename2 = null;
        if ($request->file_sk_diangkat) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_sk_diangkat')->getClientOriginalName());
            $request->file('file_sk_diangkat')->move(public_path('struktural'), $filename);
        }

        if ($request->file_sk_berhenti) {
            $filename2 = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_sk_berhenti')->getClientOriginalName());
            $request->file('file_sk_berhenti')->move(public_path('struktural'), $filename2);
        }


        $input = $request->all();
        $input['file_sk_diangkat'] = $filename ;
        $input['file_sk_berhenti'] = $filename2;

        RiwayatStruktural::find($id)->update($input);
        return redirect()->route('struktural.index', ['id'=>$request->pegawai_id]);
    }

    public function show(RiwayatStruktural $id)
    {
        // dd($id);
        $data = $id;
        $nama_pegawai = Pegawai::select('nama')->find($id->pegawai_id);
        // dd($nama_pegawai);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Struktural ';
        $table_id = 'riwayat_struktural';
        $nama   = $nama_pegawai->nama;

        return view('Struktural.show', compact('subtitle', 'table_id', 'icon', 'data', 'nama'));
    }
}
