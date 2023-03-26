<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Informasis;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index()
    {
        $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
        $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Layanan Pengaduan"]];
        $data = Pengaduan::where('id_users', '=', Auth::user()->id)->get()->map(function($pengaduan) {
          $pengaduan->tanggal = date('m-d-Y', strtotime($pengaduan->tanggal));
        return $pengaduan;});      
        $val = array('primary','secondary','warning','danger','info');
        $status = User::where('users.id','=',Auth::user()->id)->join('wargas','wargas.id_users','=','users.id')->count();
        return view('layouts/admin/pengaduan', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'status'=>$status]);
    }

    public function pengaduan_data()
    {
      $user=Pengaduan::orderBy('id')->get();
      return ['data' => $user];
    }
    public function pengaduan_add(Request $request){
      $validator = Validator::make($request->all(), [
        'judul' => 'required',
        'keterangan' => 'required',
        'tanggal' => 'required',
        'nama'=> 'required',
        'info_file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      ]);
  
      if ($validator->fails()) {
        dd($validator);
        session()->flash('error', 'Periksa ulang kembali.');
        return redirect()->route('pengaduan-warga')->withErrors($validator)
      ->withInput();;
      }
      if($request->info_file){
        $path_logo = 'pengaduan/'.time().'.pengaduan.'.$request->info_file->extension();
        // Public Folder
        $request->info_file->storeAs('images', $path_logo,'public');
      }else{
        $path_logo='';
      }
      $user = Pengaduan::updateOrCreate([
          'id' => $request->id
      ], [
        'id_users'=>Auth::user()->id,
          'judul' => $request->judul,
          'keterangan' => $request->keterangan,
          'tanggal' => $request->tanggal,
          'nama' => $request->nama,
          'foto' => $path_logo
      ]);
      if($user){
          session()->flash('success', 'Data Berhasil Ditambah.');
          //redirect
      }
      return redirect()->route('pengaduan-admin');
    }
    public function lap_pengaduan()
    {
        $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
        $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Laporan Pengaduan"]];
        $data = Pengaduan::where('id_users', '=', Auth::user()->id)->get()->map(function($pengaduan) {
          $pengaduan->tanggal = date('m-d-Y', strtotime($pengaduan->tanggal));
        return $pengaduan;});      
        $val = array('primary','secondary','warning','danger','info');
        $status = User::where('users.id','=',Auth::user()->id)->join('wargas','wargas.id_users','=','users.id')->count();
        return view('layouts/admin/laporan_pengaduan', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'status'=>$status]);
    }
}
