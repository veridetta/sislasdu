<?php

namespace App\Http\Controllers\kades;

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
    return view('layouts/kades/rw', ['val'=>$val,'kars'=>$kar,'rtrws'=>$rtrws,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  
  public function rw_data()
  {
    $user=User::join('rws','rws.id_users','=','users.id')->orderBy('users.name')->get();
    return ['data' => $user];
  }

}
