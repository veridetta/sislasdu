<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Aparat Desa"]];
    $kar = User::orderBy('name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/aparat', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function aparat_add(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'nik' => 'required',
      'password' => 'required',
      'jabatan' => 'required',
      'role' => 'required',
    ]);
    
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('aparat-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = User::updateOrCreate([
        'id' => $request->id
    ], [
        'name' => $request->name,
        'nik' => $request->nik,
        'password' => Hash::make($request->password),
        'jabatan' => $request->jabatan,
        'role' => $request->role
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
    $user=User::orderBy('name')->get();
    return ['data' => $user];
  }
  public function aparat_data_single(Request $request)
  {
    $user=User::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function aparat_delete(Request $request){
    $user = User::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('aparat-admin');
  }

}
