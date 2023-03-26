<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rtrw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RtrwController extends Controller
{

  public function rtrw()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "RT RW"]];
    $kar = Rtrw::orderBy('rw')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/rtrw', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function rtrw_add(Request $request){
    $validator = Validator::make($request->all(), [
      'rt' => 'required',
      'rw' => 'required',
    ]);
    
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('rtrw-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = Rtrw::updateOrCreate([
        'id' => $request->id
    ], [
        'rt' => $request->rt,
        'rw' => $request->rw
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
    return redirect()->route('rtrw-admin');
  }
  public function rtrw_data()
  {
    $user=Rtrw::orderBy('rw')->get();
    return ['data' => $user];
  }
  public function rtrw_data_single(Request $request)
  {
    $user=Rtrw::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function rtrw_delete(Request $request){
    $user = Rtrw::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('rtrw-admin');
  }

}
