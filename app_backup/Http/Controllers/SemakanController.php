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
  
    
    public function semak(Request $request)
    {   
   return view('semakan.semak');
    } 

    public function cari(Request $request)
    {   
 // $notel_sek = '0129161710' ;
$notel_sek = DB::table("datamurids")
->Join("info_asas_sekolah", "datamurids.kod_penempatan", "=", "info_asas_sekolah.kod_sekolah")
->select("info_asas_sekolah.no_telefon_sekolah" )
->where('nokp',$request->nokp)->get();

//dd($notel_sek);


/*  SELECT
	info_asas_sekolah.NO_TELEFON_SEKOLAH,
	datamurids.PENEMPATAN 
FROM
	datamurids
	INNER JOIN info_asas_sekolah ON datamurids.KOD_PENEMPATAN = info_asas_sekolah.KOD_SEKOLAH
*/

  $datamurid = DB::table('datamurids')->where('nokp',$request->nokp)->first();
    if(!$datamurid)
 
    return redirect()->back()->with('message', 'MAAF, NO KAD PENGENALAN SALAH ATAU TIADA DATA DITEMUI. SILA CUBA LAGI');

   else
   //  dd($datamurids); 
     return view('semakan.hasilsemakan', compact('datamurid','notel_sek'));
   
     }

    

}