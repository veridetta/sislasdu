<?php

namespace App\Http\Controllers\kades;

use App\Http\Controllers\Controller;
use App\Models\Rt;
use App\Models\Rtrw;
use App\Models\Rw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RtrwController extends Controller
{

  public function rtrw()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "RT RW"]];
    $kar = Rtrw::orderBy('rw')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/kades/rtrw', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
 
  public function rtrw_data()
  {
    $data_rt_rw = Rtrw::orderBy('id')
                    ->join('rts', function($join) {
                        $join->on('rtrws.rt', '=', DB::raw("SUBSTRING_INDEX(rts.rt, '/', 1)"))
                             ->on('rtrws.rw', '=', DB::raw("SUBSTRING_INDEX(rts.rt, '/', -1)"));
                    })
                    ->join('rws', 'rtrws.rw', '=', 'rws.rw')
                    ->select('rtrws.*', 'rts.name','rts.rt as nomor_rt', 'rws.name','rws.rw as nomor_rw')
                    ->get();
                    
                    $data_rt = Rtrw::join('rts', function($join) {
                      $join->on('rtrws.rt', '=', DB::raw("SUBSTRING_INDEX(rts.rt, '/', 1)"))
                           ->on('rtrws.rw', '=', DB::raw("SUBSTRING_INDEX(rts.rt, '/', -1)"));
                  })
                  ->select('rts.name','rts.rt')
                  ->orderBy('rts.id')
                  ->get();
              
              $data_rw = Rtrw::join('rws', 'rtrws.rw', '=', 'rws.rw')
                  ->select('rws.name','rws.rw')
                  ->orderBy('rws.id')
                  ->get();
              
              $result = $data_rt->concat($data_rw);
    return ['data' => $result];
  }
  

}
