<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function redirect()
  {
    $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->intended('admin');
            case 'kades':
                return redirect()->intended('kades');
            case 'rt':
              return redirect()->intended('rtrw');
            case 'rw':
              return redirect()->intended('rtrw');
            case 'warga':
              return redirect()->intended('warga');
            default:
                return redirect('/');
        }
  }

  public function home(){
    return view('auth.login');
  }
  public function register(){
    return view('auth.register');
  }
  public function dashboard(){
    return view('dashboard');
  }
  public function info()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'','navbarColor'=>'bg-light-danger'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => "Warga"], ['name' => "Beranda"]];
    $data=Informasi::get();
    $val = array('primary','secondary','warning','danger','info');
    //dd($user->id. $user->name);
    return view('informasi', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
}
