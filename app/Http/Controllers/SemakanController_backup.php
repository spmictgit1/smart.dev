<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use App\Http\Requests\Admin\StoreDatamuridsRequest;
use App\Http\Requests\Admin\UpdateDatamuridsRequest;
use App\Datamurid;
use App\Datasekolah;


class SemakanController extends Controller
{
    public function semak()
    {   
     
   return view('semakan.semak');
    } 

    public function cari(Request $request)
    {   
      $sekolahdirayu = DB::table('tbrayuans')->where('nokp',$request->nokp)
      ->select('*')
      ->first();  
     // if(!$sekolahdirayu)
     // $sekolahdirayu = 

        $notel_sek = DB::table("datamurids")
        ->Join("info_asas_sekolah", "datamurids.kod_penempatan", "=", "info_asas_sekolah.kod_sekolah")
        ->select("info_asas_sekolah.no_telefon_sekolah" )
        ->where('nokp',$request->nokp)->get();


    $datamurid = DB::table('datamurids')->where('nokp',$request->nokp)->first();
    //dd($datamurid);
    if(!$datamurid)

    return redirect()->route('semak')->with(['error' => 'Maaf, No Kad Pengenalan tidak sah. Sila cuba lagi']);
   
    else

    $listsekolahpilihan_kaa = DB::table('datasekolahs')
    ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                      SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                      quota_L_kaa-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                      quota_P_kaa-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                      quota_L_kaa,quota_P_kaa,ds_nama_sekolah,kod_sekolah,ppd')) 
 
    ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
    ->where('sekolah_kaa','=','KAA')
    //->where('kod_ppd', '=', Auth::user()->kod_organisasi)
    ->groupBy('quota_L_kaa','quota_P_kaa','ds_nama_sekolah','kod_sekolah','ppd')
    ->get();
    
    $listsekolahpilihan_sabk_dini = DB::table('datasekolahs')
    ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                      SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                      quota_L_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                      quota_P_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                      quota_L_sabk_dini,quota_P_sabk_dini,ds_nama_sekolah,kod_sekolah,ppd')) 
 
     ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
    ->where('sekolah_sabk_dini','=','DINI')
    //->where('kod_ppd', '=', Auth::user()->kod_organisasi)
    ->groupBy('quota_L_sabk_dini','quota_P_sabk_dini','ds_nama_sekolah','kod_sekolah','ppd')
    ->get();
 
    $listsekolahpilihan_sabk_tahfiz = DB::table('datasekolahs')
    ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                      SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                      quota_L_sabk_tahfiz-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                      quota_P_sabk_tahfiz-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                      quota_L_sabk_tahfiz,quota_P_sabk_tahfiz,ds_nama_sekolah,kod_sekolah,ppd')) 
 
     ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
    ->where('sekolah_sabk_tahfiz','=','TAHFIZ')
    //->where('kod_ppd', '=', Auth::user()->kod_organisasi)
    ->groupBy('quota_L_sabk_tahfiz','quota_P_sabk_tahfiz','ds_nama_sekolah','kod_sekolah','ppd')
    ->get();

  // dd($listsekolahpilihan_kaa);
     return view('semakan.hasilsemakan', compact('datamurid','notel_sek','listsekolahpilihan_kaa','listsekolahpilihan_sabk_dini','listsekolahpilihan_sabk_tahfiz','sekolahdirayu'));
     }

    
     




}