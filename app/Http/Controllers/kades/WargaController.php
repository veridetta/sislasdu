<?php

namespace App\Http\Controllers\kades;

use App\Http\Controllers\Controller;
use App\Models\Rtrw;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WargaController extends Controller
{

  public function warga()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Warga Desa"]];
    $rtrws=Rtrw::get();
    $kar = User::join('wargas','wargas.id_users','=','users.id')->orderBy('users.name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/kades/warga', ['val'=>$val,'kars'=>$kar,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
 
  public function warga_data()
  {
    $user=User::join('wargas','wargas.id_users','=','users.id')->orderBy('users.name')->where('users.role','=','warga')->get();
    return ['data' => $user];
  }

}
