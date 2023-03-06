<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function calculation()
    {
    
        $kira_dashboard = DB::table('datamurids')
     
       ->select (DB::raw('
        sum(CASE WHEN KOD_PENEMPATAN != "" THEN 1 ELSE 0 END) as berjaya,
        (sum(CASE WHEN NOKP  != "" THEN 1 ELSE 0 END))-(sum(CASE WHEN KOD_PENEMPATAN != "" THEN 1 ELSE 0 END)) as gagal,
        (sum(CASE WHEN NOKP  != "" THEN 1 ELSE 0 END)) as jum_calon
        '))
        
        //->groupBy('PPD_DM')
        //->having('PPD_DM_KOD', '=', Auth::user()->kod_organisasi)    
        ->limit(30)
        ->get(); 

        $kira_dashboard_sekolah = DB::table('datamurids')
     
       ->select (DB::raw('
        sum(CASE WHEN KOD_PENEMPATAN != "" THEN 1 ELSE 0 END) as berjaya,
        SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as Lelaki,
        SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as Perempuan
        '))
        
        //->groupBy('PPD_DM')
        //->having('PPD_DM_KOD', '=', Auth::user()->kod_organisasi)
        ->where('kod_penempatan', '=', Auth::user()->kod_organisasi) 
        ->limit(30)
        ->get();
        
        $kira_terima_tolak = DB::table('datamurids')
     
        ->select (DB::raw('
         sum(CASE WHEN sahterima = "1" THEN 1 ELSE 0 END) as TERIMA,
         sum(CASE WHEN sahterima != "1" THEN 1 ELSE 0 END) as TOLAK
         '))
         
         //->groupBy('PPD_DM')
         //->having('PPD_DM_KOD', '=', Auth::user()->kod_organisasi)
         ->where('kod_penempatan', '=', Auth::user()->kod_organisasi) 
         ->limit(30)
         ->get();



         $kira_dashboard_ppd = DB::table('datamurids')
     
         ->select (DB::raw('
          sum(CASE WHEN KOD_PENEMPATAN != "" THEN 1 ELSE 0 END) as BERJAYA,
          (CASE 
          WHEN KOD_PENEMPATAN IN 
                ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                "MEA1081","MEB1063","MEB1064","MEB1065","MFT1001","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                THEN "M010"

          WHEN KOD_PENEMPATAN IN 
                ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                )
                THEN "M020"

          WHEN KOD_PENEMPATAN IN 
                ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                THEN "M030"
                
          ELSE "" END) as PPD_KOD_PENEMPATAN

          '))
          
          ->groupBy('PPD_KOD_PENEMPATAN')
          ->having('PPD_KOD_PENEMPATAN', '=', Auth::user()->kod_organisasi)
         // ->where('PPD_KOD_PENEMPATAN', '=', Auth::user()->kod_organisasi) 
        //  ->limit(30)
          ->get();
         




          
  //  dd($kira_dashboard_ppd);

     
        return view('/home', compact('kira_dashboard','kira_dashboard_sekolah','kira_terima_tolak'));
    }

   
}


 /*  $kira = DB::table('datasekolahs')
        ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as ADA_TEMPAT,
                          SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                          quota_L_kaa-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                          quota_P_kaa-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                          quota_L_kaa,quota_P_kaa,ds_nama_sekolah,kod_sekolah,ppd')) 
     
        ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
      //  ->where('sekolah_kaa','=','KAA')
      //  ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
        ->groupBy('quota_L_kaa','quota_P_kaa','ds_nama_sekolah','kod_sekolah','ppd')
        ->get();
        
       */
        
      
       //dd($kira);
