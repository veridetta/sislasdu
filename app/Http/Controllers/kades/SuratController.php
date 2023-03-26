<?php

namespace App\Http\Controllers\kades;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Rw;
use App\Models\surat;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuratController extends Controller
{

  public function lap_surat()
    {
        $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
        $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Layanan Pengaduan"]];
        $data = surat::where('id_users', '=', Auth::user()->id)->get()->map(function($pengaduan) {$pengaduan->created_at = date('m-d-Y', strtotime($pengaduan->created_at));
        return $pengaduan;});      
        $val = array('primary','secondary','warning','danger','info');
        $status = User::where('users.id','=',Auth::user()->id)->join('wargas','wargas.id_users','=','users.id')->count();
        return view('layouts/kades/laporan_surat', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'status'=>$status]);
    }
    public function rekap_data()
  {
    $user = Surat::join('jenis_surats', 'jenis_surats.kode', '=', 'surats.id_jenissurat')
             ->selectRaw('surats.id_jenissurat, jenis_surats.nama, COUNT(*) as jumlah_surat')
             ->groupBy('surats.id_jenissurat', 'jenis_surats.nama')
             ->orderBy('surats.id_jenissurat')
             ->get();


    return ['data' => $user];
  }
}
