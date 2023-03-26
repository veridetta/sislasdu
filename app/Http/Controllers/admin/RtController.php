<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rtrw;
use App\Models\User;
use App\Models\rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RtController extends Controller
{

  public function rt()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Ketua RT"]];

    $rtrws=Rtrw::get();
    $kar = User::join('rts','rts.id_users','=','users.id')->orderBy('users.name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/rt', ['val'=>$val,'kars'=>$kar,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function rt_add(Request $request){
    
    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'nik' => 'required',
      'password' => 'required',
      'rt' => 'required'
    ]);
    
    if ($validator->fails()) {
        dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('rt-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = User::updateOrCreate([
        'id' => $request->id_users
    ], [
        'name' => $request->nama,
        'nik' => $request->nik,
        'password' => Hash::make($request->password),
        'jabatan' => 'rt',
        'role' => 'rt'
    ]);
    $bio = rt::updateOrCreate([
        'id' => $request->id
    ], [
        'id_users'=>$user->id,
        'name' => $request->nama,
        'rt' => $request->rt,
        'rw' => $request->rt
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
    return redirect()->route('rt-admin');
  }
  public function rt_data()
  {
    $user=User::join('rts','rts.id_users','=','users.id')->orderBy('users.name')->get();
    return ['data' => $user];
  }
  public function rt_data_single(Request $request)
  {
    //$user=User::where('id','=',$request->id)->first();
    $user=User::join('rts','rts.id_users','=','users.id')->where('users.id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function rt_delete(Request $request){
    $user_data = User::where('id','=',$request->id);
    $rt = rt::where('id','=',$user_data->first()->id)->delete();
    $user = $user_data->delete();

    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('rt-admin');
  }

}
