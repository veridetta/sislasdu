<?php

namespace App\Http\Controllers;

use App\Models\Absensis;
use App\Models\Cutis;
use App\Models\Lamarans;
use App\Models\Mundurs;
use App\Models\Pelanggarans;
use App\Models\User;
use App\Models\Warga;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  public function dashboard()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'','navbarColor'=>'bg-light-danger'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Beranda"]];
    $terdaftar=Warga::count();
    $laki=Warga::where('jk','=','Laki-laki')->count();
    $perem=Warga::where('jk','=','Perempuan')->count();
    $dewasa = Warga::all()->map(function ($warga) {
      return Carbon::parse(Carbon::createFromFormat('d/m/Y', $warga->tanggal_lahir))->age;
    })->filter(function ($age) {
        return $age > 17;
    })->count();
    $anak=Warga::all()->map(function ($warga) {
      return Carbon::parse(Carbon::createFromFormat('d/m/Y', $warga->tanggal_lahir))->age;
    })->filter(function ($age) {
        return $age < 17;
    })->count();

    $val = array('primary','secondary','warning','danger','info');
    $user = User::where('id','=',Auth::user()->id)->first();
    return view('layouts/admin/dashboard', ['val'=>$val,'terdaftar'=>$terdaftar,'laki'=>$laki,'perem'=>$perem,'dewasa'=>$dewasa,'anak'=>$anak,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'user'=>$user]);
  }
  public function pelamar()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Pelamar"]];


    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/pelamar', ['val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function pelamar_data()
  {
    $user=User::join('lamarans','lamarans.id_users','=','users.id')->where('users.role','=','pelamar')->get();
    return ['data' => $user];
  }
  public function karyawan()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Karyawan"]];
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/karyawan', ['val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function karyawan_data()
  {
    $user=User::join('lamarans','lamarans.id_users','=','users.id')->where('users.role','=','karyawan')->get();
    return ['data' => $user];
  }
  public function absensi()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Absensi"]];
    $kar = User::join('lamarans','lamarans.id_users','=','users.id')->where('users.role','=','karyawan')->orderBy('name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/absensi', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function absensi_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_users' => 'required',
      'tanggal' => 'required',
      'in' => 'required',
      'out' => 'required',
      'ket' => 'required',
    ]);
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('absensi-admin')->withErrors($validator)
      ->withInput();;
    }
    $nn = explode('&&',$request->id_users);
    $user = Absensis::updateOrCreate([
        'id' => $request->id
    ], [
        'id_users' => $nn[0],
        'nip' => $nn[1],
        'nama' =>$nn[2],
        'tanggal' => $request->tanggal,
        'in' => $request->in,
        'out' => $request->out,
        'ket' => $request->ket,
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
    }
    return redirect()->route('absensi-admin');
  }
  public function absensi_data()
  {
    $user=Absensis::get();
    return ['data' => $user];
  }
  public function absensi_data_single(Request $request)
  {
    $user=Absensis::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function absensi_delete(Request $request){
    $user = Absensis::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('absensi-admin');
  }

  public function gaji()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Gaji"]];
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/gaji', ['val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function gaji_data(Request $request)
  {
    if($request->bulan!=="kosong"){
      $bulan = $request->bulan;
      $tahun = $request->tahun;
      $id_users = $request->id_users;
      $slip = Absensis::whereMonth('tanggal','=',$bulan)->whereYear('tanggal','=',$tahun)->get();
        $user = Lamarans::where('id_users','=',$id_users)->first();
        $fee=50000;
        $bpjs=50000;
        $jamsos=30000;
        $gaji_kotor=$fee*$slip->count();
        $gaji_bulan = ($fee*$slip->count())-$jamsos-$bpjs;
        $total_pot = $jamsos+$bpjs;
        $sekarang=Carbon::now()->format('d-m-Y');
        $arr= array(
          "nama"=>$user->nama,
          "id_users"=>$user->id,
          "nip"=>$user->nip,
          "bulan"=>$bulan,
          "tahun"=>$tahun,
          "gaji_kotor"=>$gaji_kotor,
          "gaji"=>$gaji_bulan,
          "periode"=> $bulan.'-'.$tahun,
          "bpjs" => $bpjs,
          "jamsos"=>$jamsos,
          "total_pot"=>$total_pot,
          "sekarang"=>$sekarang
        );
    }else{
      $months = Absensis::get()->groupBy(function($d) {return Carbon::parse($d->created_at)->format('m');});
      $arr = array();
      $no=0;
      foreach($months as $month){
        if($request->bulan!=="kosong"){

        }else{
          $bulan = Carbon::parse($month[$no]->tanggal)->format('m');
          $tahun = Carbon::parse($month[$no]->tanggal)->format('Y');
          $id_users = $month[$no]->id_users;
        }
        $slip = Absensis::whereMonth('tanggal','=',$bulan)->whereYear('tanggal','=',$tahun)->get();
        $user = Lamarans::where('id_users','=',$id_users)->first();
        $fee=50000;
        $bpjs=50000;
        $jamsos=30000;
        $gaji_kotor=$fee*$slip->count();
        $gaji_bulan = ($fee*$slip->count())-$jamsos-$bpjs;
        $total_pot = $jamsos+$bpjs;
        $sekarang=Carbon::now()->format('d-m-Y');
        $are= array(
          "nama"=>$user->nama,
          "id_users"=>$user->id,
          "nip"=>$user->nip,
          "bulan"=>$bulan,
          "tahun"=>$tahun,
          "gaji_kotor"=>$gaji_kotor,
          "gaji"=>number_format($gaji_bulan),
          "periode"=> $bulan.'-'.$tahun,
          "bpjs" => $bpjs,
          "jamsos"=>$jamsos,
          "total_pot"=>$total_pot,
          "sekarang"=>$sekarang
        );
        $no++;
        array_push($arr,$are);
      }
    }
    
    if($request->download=="download"){
      $pdf = Pdf::loadView('layouts/users/karyawan/slip', ['data'=>$arr])->setPaper('a4', 'landscape');;
      return $pdf->download('Gaji-Karyawan.pdf');
    }else if($request->download=="view"){
      return view('layouts/users/karyawan/slip',['data'=>$arr]);
    }
    return ['data' => $arr];
  }
  public function cuti()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Cuti"]];

    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/cuti', ['val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function cuti_add(Request $request){
    $user = Cutis::updateOrCreate([
        'id' => $request->id
    ], [
        'status' => $request->status,
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Disimpan.');
        //redirect
    }
    return redirect()->route('cuti-admin');
  }
  public function cuti_data()
  {
    $user=Cutis::get();
    return ['data' => $user];
  }
  public function mundur()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Pengunduran Diri"]];

    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/mundur', ['val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function mundur_add(Request $request){
    $user = Mundurs::updateOrCreate([
        'id' => $request->id
    ], [
        'status' => $request->status,
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Disimpan.');
        //redirect
    }
    return redirect()->route('mundur-admin');
  }
  public function mundur_data()
  {
    $user=Mundurs::get();
    return ['data' => $user];
  }
  public function pelanggaran()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Pelanggaran"]];

    $kar = User::join('lamarans','lamarans.id_users','=','users.id')->where('users.role','=','karyawan')->orderBy('name')->get();


    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/pelanggaran', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function pelanggaran_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_users' => 'required',
      'tanggal' => 'required',
      'jenis' => 'required',
      'keterangan' => 'required'
    ]);
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('pelanggaran-admin')->withErrors($validator)
      ->withInput();;
    }
    $nn = explode('&&',$request->id_users);
    $user = Pelanggarans::updateOrCreate([
        'id' => $request->id
    ], [
        'id_users' => $nn[0],
        'nip' => $nn[1],
        'nama' =>$nn[2],
        'tanggal' => $request->tanggal,
        'jenis' => $request->jenis,
        'keterangan' => $request->keterangan
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
    }
    return redirect()->route('pelanggaran-admin');
  }
  public function pelanggaran_data()
  {
    $user=Pelanggarans::get();
    return ['data' => $user];
  }
  public function pelanggaran_data_single(Request $request)
  {
    $user=Pelanggarans::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function pelanggaran_delete(Request $request){
    $user = Pelanggarans::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('pelanggaran-admin');
  }
}
