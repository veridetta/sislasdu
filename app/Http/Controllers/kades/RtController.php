<?php

namespace App\Http\Controllers\kades;

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
    return view('layouts/kades/rt', ['val'=>$val,'kars'=>$kar,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function rt_data()
  {
    $user=User::join('rts','rts.id_users','=','users.id')->orderBy('users.name')->get();
    return ['data' => $user];
  }
}
