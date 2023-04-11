<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rtrw;
use App\Models\User;
use App\Models\rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RwController extends Controller
{

  public function rw()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Ketua RW"]];

    $rtrws=Rtrw::get();
    $kar = User::join('rws','rws.id_users','=','users.id')->orderBy('users.name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/rw', ['val'=>$val,'kars'=>$kar,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function rw_add(Request $request){
    
    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'nik' => 'required',
      'password' => 'required',
      'rw' => 'required',
      'email' => 'required'
    ]);
    
    if ($validator->fails()) {
        dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('rw-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = User::updateOrCreate([
        'id' => $request->id_users
    ], [
        'name' => $request->nama,
        'nik' => $request->nik,
        'password' => Hash::make($request->password),
        'jabatan' => 'rw',
        'email' => $request->email,
        'role' => 'rw'
    ]);
    $bio = Rw::updateOrCreate([
        'id' => $request->id
    ], [
        'id_users'=>$user->id,
        'name' => $request->nama,
        'rw' => $request->rw,
        'email' => $request->email
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
    return redirect()->route('rw-admin');
  }
  public function rw_data()
  {
    $user=User::join('rws','rws.id_users','=','users.id')->orderBy('users.name')->get();
    return ['data' => $user];
  }
  public function rw_data_single(Request $request)
  {
    //$user=User::where('id','=',$request->id)->first();
    $user=User::join('rws','rws.id_users','=','users.id')->where('users.id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function rw_delete(Request $request){
    $user_data = User::where('id','=',$request->id);
    $rw = Rw::where('id','=',$user_data->first()->id)->delete();
    $user = $user_data->delete();

    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('rw-admin');
  }

}
