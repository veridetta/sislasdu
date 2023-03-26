<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rtrw;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WargaController extends Controller
{

  public function warga()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Warga Desa"]];
    $rtrws=Rtrw::get();
    $kar = User::join('wargas','wargas.id_users','=','users.id')->orderBy('users.name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/warga', ['val'=>$val,'kars'=>$kar,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function warga_add(Request $request){
    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'nik' => 'required',
      'password' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jk' => 'required',
      'goldar' => 'required',
      'agama' => 'required',
      'pekerjaan' => 'required',
      'pendidikan' => 'required',
      'st_nikah' => 'required',
      'st_tinggal' => 'required',
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
      return redirect()->route('warga-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = User::updateOrCreate([
        'id' => $request->id_users
    ], [
        'name' => $request->nama,
        'nik' => $request->nik,
        'password' => Hash::make($request->password),
        'jabatan' => 'warga',
        'role' => 'warga'
    ]);
    $bio = Warga::updateOrCreate([
        'id' => $request->id
    ], [
        'id_users'=>$user->id,
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
    return redirect()->route('warga-admin');
  }
  public function warga_data()
  {
    $user=User::join('wargas','wargas.id_users','=','users.id')->orderBy('users.name')->get();
    return ['data' => $user];
  }
  public function warga_data_single(Request $request)
  {
    //$user=User::where('id','=',$request->id)->first();
    $user=User::join('wargas','wargas.id_users','=','users.id')->where('users.id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function warga_delete(Request $request){
    $user_data = User::where('id','=',$request->id);
    $warga = Warga::where('id','=',$user_data->first()->id)->delete();
    $user = $user_data->delete();

    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('warga-admin');
  }

}
