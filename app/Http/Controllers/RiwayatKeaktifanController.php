<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatKeaktifan;
use App\Models\StatusKeaktifan;
use App\Models\SubUnit;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiwayatKeaktifanController extends Controller
{
    public function index($id)
    {
        $nama_pegawai = Pegawai::select('nama')->find($id);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Keaktifan';
        $table_id = 'riwayat_struktural';
        $nama   = $nama_pegawai->nama;
        // $data = RiwayatStruktural::where('pegawai_id', 137)->get();
        // dd($data);

        return view('Keaktifan.index', compact('subtitle', 'table_id', 'icon', 'id', 'nama'));
    }

    public function list(Request $request)
    {
        $data = RiwayatKeaktifan::where('pegawai_id', $request->id)->get();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/pegawai/keaktifan/".$data->riwayat_keaktifan_id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>  ";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->riwayat_keaktifan_id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->riwayat_keaktifan_id}' data-nim='{$data->nim}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a>   ";
                    $aksi .= "<a title='Show Data' href='/pegawai/keaktifan/show/".$data->riwayat_keaktifan_id."' class='btn btn-md btn-info' data-id='{$data->riwayat_keaktifan_id}' ><i class='ti-info' data-toggle='tooltip' data-placement='bottom' ></i></a>   ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function delete($id)
    {
        if (RiwayatKeaktifan::destroy($id)) {
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Riwayat Keaktifan';

        $keaktifan  = StatusKeaktifan::get();
        $unit       = Unit::get();
        $sub_unit   = SubUnit::get();


        return view('Keaktifan.create', compact('subtitle', 'icon', 'id'), [
            'unit'  => $unit,
            'keaktifan'  => $keaktifan,
            'sub_unit'   => $sub_unit
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->status_keaktifan_id);
        $request->validate([

        ]);
        $request['created_by'] = 1;
        $filename = null;
        if ($request->file_riwayat_keaktifan) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_riwayat_keaktifan')->getClientOriginalName());
            $request->file('file_riwayat_keaktifan')->move(public_path('keaktifan'), $filename);
        }


        $input = $request->all();
        $input['file_riwayat_keaktifan'] = $filename ;

        RiwayatKeaktifan::create($input);
        return redirect()->route('keaktifan.index', ['id'=>$request->pegawai_id]);
    }

    public function edit($id)
    {
        $data = RiwayatKeaktifan::find($id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Keaktifan';

        // dd($data->keaktifan);
        $keaktifan  = StatusKeaktifan::get();
        $unit       = Unit::get();
        $sub_unit   = SubUnit::get();

        return view('Keaktifan.edit', compact('subtitle', 'icon', 'id', 'data'), [
            'unit'  => $unit,
            'keaktifan'  => $keaktifan,
            'sub_unit'   => $sub_unit
        ]);
    }

    public function update(Request $request, $id)
    {
        $filename = null;
        if ($request->file_riwayat_keaktifan) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('file_riwayat_keaktifan')->getClientOriginalName());
            $request->file('file_riwayat_keaktifan')->move(public_path('keaktifan'), $filename);
        }


        $input = $request->all();
        $input['file_riwayat_keaktifan'] = $filename ;

        RiwayatKeaktifan::find($id)->update($input);
        return redirect()->route('keaktifan.index', ['id'=>$request->pegawai_id]);
    }

    public function show(RiwayatKeaktifan $id)
    {
        // dd($id);
        $data = $id;
        $nama_pegawai = Pegawai::select('nama')->find($id->pegawai_id);
        // dd($nama_pegawai);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Keaktifan ';
        $table_id = 'riwayat_keaktifan';
        $nama   = $nama_pegawai->nama;

        return view('Keaktifan.show', compact('subtitle', 'table_id', 'icon', 'data', 'nama'));
    }
}
