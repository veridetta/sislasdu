<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Informasis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformasiController extends Controller
{
    public function index()
    {
        $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
        $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Aparat Desa"]];
        $kar = User::orderBy('name')->get();
        $data=Informasi::get();
        $val = array('primary','secondary','warning','danger','info');
        return view('layouts/admin/info', ['val'=>$val,'data'=>$data,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    public function info_add(Request $request){
      $validator = Validator::make($request->all(), [
        'judul' => 'required',
        'isi' => 'required',
        'tanggal' => 'required',
        'info_file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      ]);
  
      if ($validator->fails()) {
        dd($validator);
        session()->flash('error', 'Periksa ulang kembali.');
        return redirect()->route('info-admin')->withErrors($validator)
      ->withInput();;
      }
      if($request->info_file){
        $path_logo = 'informasi/'.time().'.informasi.'.$request->info_file->extension();
        // Public Folder
        $request->info_file->storeAs('images', $path_logo,'public');
      }else{
        $path_logo='';
      }
      $user = Informasi::updateOrCreate([
          'id' => $request->id
      ], [
          'judul' => $request->judul,
          'isi' => $request->isi,
          'tanggal' => $request->tanggal,
          'foto' => $path_logo
      ]);
      if($user){
          session()->flash('success', 'Data Berhasil Ditambah.');
          //redirect
      }
      return redirect()->route('info-admin');
    }
}
