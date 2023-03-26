<?php

namespace App\Http\Controllers\kades;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AparatController extends Controller
{

  public function aparat()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Aparat Desa"]];
    $kar = User::orderBy('name')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/kades/aparat', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function aparat_data()
  {
    $user=User::orderBy('name')->get();
    return ['data' => $user];
  }

}
