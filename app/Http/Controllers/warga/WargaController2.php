<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use App\Models\Absensis;
use App\Models\Cutis;
use App\Models\Informasi;
use App\Models\Lamarans;
use App\Models\Mundurs;
use App\Models\Pelanggarans;
use App\Models\Rtrw;
use App\Models\User;
use App\Models\Warga;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WargaController2 extends Controller
{
  public function dashboard()
  {
    $id=Auth::user()->id;
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'','navbarColor'=>'bg-light-danger'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => "Warga"], ['name' => "Beranda"]];
    $data=Informasi::get();
    $val = array('primary','secondary','warning','danger','info');
    $user = User::where('id','=',$id)->first();
    $status=Warga::where('id_users','=',$user->id)->count();
    //dd($user->id. $user->name);
    return view('layouts/warga/dashboard', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'user'=>$user,'status'=>$status]);
  }
  
  public function warga()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Data Saya"]];
    $data=Warga::where('id_users','=',Auth::user()->id)->first();
    $status=Warga::where('id_users','=',Auth::user()->id)->count();
    $rtrws=Rtrw::get();
    $kar = User::join('wargas','wargas.id_users','=','users.id')->where('users.id','=',Auth::user()->id)->orderBy('users.name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/warga/data', ['val'=>$val,'kars'=>$kar,'data'=>$data,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'status'=>$status]);
  }
  public function warga_add(Request $request){
    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'nik' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jk' => 'required',
      'goldar' => 'required',
      'agama' => 'required',
      'pekerjaan' => 'required',
      'pendidikan' => 'required',
      'st_nikah' => 'required',
      'st_tinggal' => 'required',
      'email' => 'required',
      'st_warga' => 'required',
      'rtrw' => 'required',
      'desa' => 'required',
      'kecamatan' => 'required',
      'kota' => 'required',
      'provinsi' => 'required'
    ]);
    
    if ($validator->fails()) {
        dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('warga-warga')->withErrors($validator)
      ->withInput();;
    }
    $pengguna = User::updateOrCreate([
      'id' => $request->id_users
    ], [
      'name' => $request->nama,
      'email' => $request->email,
      'nik' => $request->nik]);
    $user = Warga::updateOrCreate([
        'id' => $request->id
    ], [
        'id_users'=>Auth::user()->id,
        'nama' => $request->nama,
        'nik' => $request->nik,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jk' => $request->jk,
        'goldar' => $request->goldar,
        'agama' => $request->agama,
        'pekerjaan' => $request->pekerjaan,
        'pendidikan' => $request->pendidikan,
        'st_nikah' => $request->st_nikah,
        'st_tinggal' => $request->st_tinggal,
        'st_warga' => $request->st_warga,
        'rt' => $request->rtrw,
        'rw' => $request->rtrw,
        'desa' => $request->desa,
        'kecamatan' => $request->kecamatan,
        'kota' => $request->kota,
        'provinsi' => $request->provinsi
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
    return redirect()->route('warga-warga');
  }
  public function warga_data()
  {
    $user=User::join('wargas','wargas.id_users','=','users.id')->where('users.id','=',Auth::user()->id)->orderBy('users.name')->get();
    return ['data' => $user];
  }
  public function warga_data_single(Request $request)
  {
    //$user=User::where('id','=',$request->id)->first();
    $user=User::join('wargas','wargas.id_users','=','users.id')->where('users.id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function warga_delete(Request $request){
    //$user_data = User::where('id','=',$request->id);
    $user_data = Warga::where('id','=',$request->id)->delete();
    $user = $user_data->delete();

    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('warga-warga');
  }
}
