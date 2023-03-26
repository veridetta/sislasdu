<?php

namespace App\Http\Controllers\admin;

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

  public function surat()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Layanan Surat"]];
    $jenis = JenisSurat::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    $layout='layouts/admin/surat';
    if(Auth::user()->role=='rt' or Auth::user()->role=='rw'){
        $layout='layouts/rtrw/surat';
    }
    return view($layout, ['val'=>$val,'jeniss'=>$jenis,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  
  public function surat_data()
  {
    $user=surat::orderBy('id')->select("surats.*",DB::raw('DATE_FORMAT(surats.created_at, "%Y-%m-%d") as tanggal'))->get();
    return ['data' => $user];
  }
  
  public function cetak(Request $request){
    $surat = surat::join('wargas','wargas.id_users','=','surats.id_users')->join('rts','rts.rt','=','wargas.rt')->where('surats.id','=',$request->id)->first();
    $rwno=explode('/',$surat->rt);
    $rw=Rw::where('rw','=',$rwno[1])->first();
    setlocale(LC_ALL, 'IND');
    $tanggal = Carbon::createFromDate($surat->updated_at)->formatLocalized('%d %B %Y');
    $layout='';
    switch ($surat->id_jenissurat) {
        case 'SK-HILANG':
            $layout='layouts.warga.cetak_kehilangan';
            break;
        case 'SK-BNKH':
            $layout='layouts.warga.cetak_belum_nikah';
            break;
        case 'SK-DOM':
            $layout='layouts.warga.cetak_domisili';
            break;
        case 'SK-DU':
            $layout='layouts.warga.cetak_duda';
            break;
        case 'SK-JA':
            $layout='layouts.warga.cetak_janda';
            break;
        case 'SK-PRT':
            $layout='layouts.warga.cetak_pengantar';
            break;
        default:
            # code...
            break;
    }
    
    //return view($layout,['surat'=>$surat,'tanggal'=>$tanggal,'rw'=>$rw]);
    $pdf = Pdf::loadView($layout,['surat'=>$surat,'tanggal'=>$tanggal,'rw'=>$rw])->setPaper('a4', 'potrait');;
    $nama = $surat->kode.' '.$surat->nama.'.pdf';
      return $pdf->download($nama);
  }

  public function lap_surat()
    {
        $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
        $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Layanan Pengaduan"]];
        $data = surat::where('id_users', '=', Auth::user()->id)->get()->map(function($pengaduan) {$pengaduan->created_at = date('m-d-Y', strtotime($pengaduan->created_at));
        return $pengaduan;});      
        $val = array('primary','secondary','warning','danger','info');
        $status = User::where('users.id','=',Auth::user()->id)->join('wargas','wargas.id_users','=','users.id')->count();
        return view('layouts/admin/laporan_surat', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'status'=>$status]);
    }
    public function update(Request $request){
        if(Auth::user()->role=='rt'){
            $stat='2';
        }else{
            $stat='3';
        }
        $user = surat::updateOrCreate([
            'id' => $request->id
        ], [
            'status' => $stat
        ]);
        if($request->id){
            if($user){
              session()->flash('success', 'Data Berhasil Disetujui.');
              //redirect
            }
          }else{
            if($user){
              session()->flash('success', 'Data Gagal Disetujui.');
              //redirect
            }
          }
          return redirect()->route('surat-rtrw');
    }
}
