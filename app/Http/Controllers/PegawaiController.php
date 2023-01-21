<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function Index()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Pegawai';
        $table_id = 'pegawai';


        // $data = Pegawai::all();
        // $datatables = DataTables::of($data);


        return view('Pegawai.index', compact('subtitle', 'table_id', 'icon'), [
            // 'pegawai' => $datatables
        ]);
    }

    public function list(Request $request)
    {
        if (auth()->user()->level == 'admin') {
            $data = Pegawai::all();
        } elseif (auth()->user()->level == 'pegawai') {
            $data = Pegawai::where('id', auth()->user()->pegawai_id)->get();
        }
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $aksi = "";
                    // $aksi .= "<a title='Edit Data' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    // $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> <br><br>";
                    $aksi .= "<a href='/pegawai/keluarga/".$data->id."' class='btn btn-md btn-primary'><i class='ti-user'></i></a>  ";
                    $aksi .= "<a href='/pegawai/struktural/".$data->id."' class='btn btn-md btn-primary' ><i class='ti-medall-alt'></i></a> ";
                    $aksi .= "<a href='/pegawai/keaktifan/".$data->id."' class='btn btn-md btn-primary' ><i class='ti-split-v-alt'></i></a>";

                    return $aksi;
                })

                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function delete(Request $request)
    {
        if (Pegawai::destroy($request->id)) {
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }
}
