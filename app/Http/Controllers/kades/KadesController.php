<?php

namespace App\Http\Controllers\kades;

use App\Http\Controllers\Controller;
use App\Models\Absensis;
use App\Models\Cutis;
use App\Models\Lamarans;
use App\Models\Mundurs;
use App\Models\Pelanggarans;
use App\Models\User;
use App\Models\Warga;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KadesController extends Controller
{
  public function dashboard()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'','navbarColor'=>'bg-light-danger'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => "Kades"], ['name' => "Beranda"]];
    $terdaftar=Warga::count();
    $laki=Warga::where('jk','=','Laki-laki')->count();
    $perem=Warga::where('jk','=','Perempuan')->count();
    $dewasa = Warga::all()->map(function ($warga) {
      return Carbon::parse(Carbon::createFromFormat('d/m/Y', $warga->tanggal_lahir))->age;
    })->filter(function ($age) {
        return $age > 17;
    })->count();
    $anak=Warga::all()->map(function ($warga) {
      return Carbon::parse(Carbon::createFromFormat('d/m/Y', $warga->tanggal_lahir))->age;
    })->filter(function ($age) {
        return $age < 17;
    })->count();

    $val = array('primary','secondary','warning','danger','info');
    $user = User::where('id','=',Auth::user()->id)->first();
    return view('layouts/kades/dashboard', ['val'=>$val,'terdaftar'=>$terdaftar,'laki'=>$laki,'perem'=>$perem,'dewasa'=>$dewasa,'anak'=>$anak,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'user'=>$user]);
  }
  
}
