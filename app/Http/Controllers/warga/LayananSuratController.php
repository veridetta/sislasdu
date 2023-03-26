<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Rtrw;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JenisSuratController extends Controller
{

  public function index()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Layanan Surat"]];
    $kar = Surat::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/jenissurat', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function jenissurat_add(Request $request){
    $validator = Validator::make($request->all(), [
      'kode' => 'required',
      'nama' => 'required',
      'keterangan' => 'required',
    ]);
    
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('jenissurat-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = jenissurat::updateOrCreate([
        'id' => $request->id
    ], [
        'kode' => $request->kode,
        'nama' => $request->nama,
        'keterangan' => $request->keterangan
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
    return redirect()->route('jenissurat-admin');
  }
  public function jenissurat_data()
  {
    $user=jenissurat::orderBy('nama')->get();
    return ['data' => $user];
  }
  public function jenissurat_data_single(Request $request)
  {
    $user=jenissurat::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function jenissurat_delete(Request $request){
    $user = jenissurat::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('jenissurat-admin');
  }

}
