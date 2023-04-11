<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Perangkat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AparatController extends Controller
{

  public function aparat()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Perangkat Desa"]];
    $kar = User::orderBy('name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/aparat', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function aparat_add(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'nik' => 'required',
      'jabatan' => 'required'
    ]);
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('aparat-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = Perangkat::updateOrCreate([
        'id' => $request->id
    ], [
        'nama' => $request->name,
        'nik' => $request->nik,
        'jabatan' => $request->jabatan
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
    return redirect()->route('aparat-admin');
  }
  public function aparat_data()
  {
    $user=Perangkat::orderBy('nama')->get();
    return ['data' => $user];
  }
  public function aparat_data_single(Request $request)
  {
    $user=Perangkat::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function aparat_delete(Request $request){
    $user = Perangkat::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('aparat-admin');
  }

}
