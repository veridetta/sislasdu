<?php

namespace App\Http\Controllers\kades;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Rtrw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JenisSuratController extends Controller
{

  public function jenissurat()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Jenis Surat"]];
    $kar = JenisSurat::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/kades/jenissurat', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function jenissurat_data()
  {
    $user=jenissurat::orderBy('nama')->get();
    return ['data' => $user];
  }

}
