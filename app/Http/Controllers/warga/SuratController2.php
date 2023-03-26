<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Rw;
use App\Models\surat;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuratController2 extends Controller
{

  public function surat()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Layanan Surat"]];
    $jenis = JenisSurat::orderBy('nama')->get();
    $status = User::where('users.id','=',Auth::user()->id)->join('wargas','wargas.id_users','=','users.id')->count();
    $user = User::where('users.id','=',Auth::user()->id)->join('wargas','wargas.id_users','=','users.id')->first();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/warga/surat', ['val'=>$val,'jeniss'=>$jenis,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'status' => $status,'user'=>$user]);
  }
  public function surat_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_jenissurat' => 'required',
      'nama' => 'required',
      'nik' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jk' => 'required',
      'agama' => 'required',
      'pekerjaan' => 'required',
      'st_nikah' => 'required',
      'alamat' => 'required',
      'keperluan' => 'required',
    ]);
    
    if ($validator->fails()) {
        dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('surat-warga')->withErrors($validator)
      ->withInput();;
    }
    $month=Carbon::now()->format('m');
    $day=Carbon::now()->format('d');
    $year=Carbon::now()->format('Y');
    $months=Carbon::now()->shortMonthName;
    $last=surat::whereRaw('MONTH(created_at) = '.$month)->count()+1;
    $kode = str_pad($last, 3, '0', STR_PAD_LEFT).'/'.$day.'-'.$months.'/'.$request->id_jenissurat.'/'.$year;
    $user = surat::updateOrCreate([
        'id' => $request->id
    ], [
        'kode' => $kode,
        'id_users' => Auth::user()->id,
        'id_jenissurat' => $request->id_jenissurat,
        'nama' => $request->nama,
        'nik' => $request->nik,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jk' => $request->jk,
        'agama' => $request->agama,
        'pekerjaan' => $request->pekerjaan,
        'st_nikah' => $request->st_nikah,
        'alamat' => $request->alamat,
        'keperluan' => $request->keperluan,
        'status' => '1'
        //1 Menunggu Konfirm RT
        //2 Menunggu Konfirm RW
    ]);
    if($request->id){
      if($user){
        session()->flash('success', 'Data Berhasil Diubah.');
        //redirect
      }
    }else{
      if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
      }
    }
    return redirect()->route('surat-warga');
  }
  public function surat_data()
  {
    $user=surat::where('id_users','=',Auth::user()->id)->orderBy('id')->get();
    return ['data' => $user];
  }
  public function surat_data_single(Request $request)
  {
    $user=surat::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function surat_delete(Request $request){
    $user = surat::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('surat-admin');
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
}
