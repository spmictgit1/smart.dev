<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Admin\StoreDatamuridsRequest;
use App\Http\Requests\Admin\UpdateDatamuridsRequest;
use App\Datamurid;
use App\Datasekolah;
class DatasekolahsController extends Controller
{
    public function index()
    {
        if (! Gate::any(['users_manage','ppd'])) {
            return abort(401);
        }
        $datasekolah = Datasekolah::where('SM_SR','=','SM')->GET();
        //dd($datasekolah);
        return view('foldatasekolahs.senaraisekolah_file',compact ('datasekolah'));
    }


    //PILIH ARIRAN DAN SIMPAN
    public function aliransimpan(Request $request)
    {
       // dd($request);

        //SIMPAN JANTINA//
        foreach ($request->sekolah_jantina_L as $id => $L ) {
            Datasekolah::where('id', $id)->update(array('sekolah_jantina_L' => $L));
           }
        foreach ($request->sekolah_jantina_P as $id => $P ) {
            Datasekolah::where('id', $id)->update(array('sekolah_jantina_P' => $P));
           }

        //SIMPAN ALIRAN 
        foreach ($request->sekolah_kaa as $id => $kaa ) {
            Datasekolah::where('id', $id)->update(array('sekolah_kaa' => $kaa));
           }
        foreach ($request->sekolah_sabk_dini as $id => $dini ) {
            Datasekolah::where('id', $id)->update(array('sekolah_sabk_dini' => $dini));
           }  
           foreach ($request->sekolah_sabk_tahfiz as $id => $tahfiz ) {
            Datasekolah::where('id', $id)->update(array('sekolah_sabk_tahfiz' => $tahfiz));
           }     
       // return response()->noContent();
       return redirect()->back()->with('message', 'DATA DISIMPAN');
    }
      // PAPARKAN QUOTA MURID SEKOLAH//
    public function quotasekolah_kaa()
    { 
        $quota_kaa = Datasekolah::where('sekolah_kaa','=','KAA' )->paginate();
        return view('foldatasekolahs.quotasekolah_kaa_file', compact ('quota_kaa'));
    }

    public function quotasekolah_dini()
    { 
        $quota_sabk_dini = Datasekolah::where('sekolah_sabk_dini','=','DINI' )->paginate();
        return view('foldatasekolahs.quotasekolah_dini_file', compact ('quota_sabk_dini'));
    }
    public function quotasekolah_tahfiz()
    { 
        $quota_sabk_tahfiz = Datasekolah::where('sekolah_sabk_tahfiz','=','TAHFIZ' )->paginate();
        return view('foldatasekolahs.quotasekolah_tahfiz_file', compact ('quota_sabk_tahfiz'));
    }
    //ISI DAN SIMPAN QUOTA MURID SEKOLAH

    public function bilquotasimpan_kaa(Request $request)
    {
        foreach ($request->quota_L_kaa as $id => $L ) {
            Datasekolah::where('id', $id)->update(array('quota_L_kaa' => $L));
           }
        foreach ($request->quota_P_kaa as $id => $P ) {
            Datasekolah::where('id', $id)->update(array('quota_P_kaa' => $P));
           }
           return redirect()->back()->with('message', 'DATA DISIMPAN');
    }

    public function bilquotasimpan_sabk_dini(Request $request)
    {
        foreach ($request->quota_L_sabk_dini as $id => $L ) {
            Datasekolah::where('id', $id)->update(array('quota_L_sabk_dini' => $L));
           }
        foreach ($request->quota_P_sabk_dini as $id => $P ) {
            Datasekolah::where('id', $id)->update(array('quota_P_sabk_dini' => $P));
           }
           return redirect()->back()->with('message', 'DATA DISIMPAN');
    }

    public function bilquotasimpan_sabk_tahfiz(Request $request)
    {
        foreach ($request->quota_L_sabk_tahfiz as $id => $L ) {
            Datasekolah::where('id', $id)->update(array('quota_L_sabk_tahfiz' => $L));
           }
        foreach ($request->quota_P_sabk_tahfiz as $id => $P ) {
            Datasekolah::where('id', $id)->update(array('quota_P_sabk_tahfiz' => $P));
           }
           return redirect()->back()->with('message', 'DATA DISIMPAN');
    }

    
    public function papar_murid_isi()
    {
        /* $users = \DB::select('SELECT * from users');
        DB::select('SELECT * FROM mahasiswas');*/

        $data_kaa = DB::table('datamurids')
        ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                          SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,ds_nama_sekolah,quota_L_kaa,quota_P_kaa,ppd,kod_ppd
        ')) 
        ->rightjoin('datasekolahs' , 'KOD_PENEMPATAN', '=', 'kod_sekolah')
        ->where('sekolah_kaa','=','KAA')
        ->where('kod_ppd','=', Auth::user()->kod_organisasi)
    
        ->groupBy('ds_nama_sekolah','quota_L_kaa','quota_P_kaa','ppd','kod_ppd')
        ->get();
        
      // dd($data_kaa );
        
        $data_sabk_dini = DB::table('datamurids')
        ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                          SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,ds_nama_sekolah,quota_L_sabk_dini,quota_P_sabk_dini,ppd
        ')) 
        ->rightjoin('datasekolahs' , 'datamurids.KOD_PENEMPATAN', '=', 'kod_sekolah')
        ->where('sekolah_sabk_dini','=','DINI')
        ->where('kod_ppd','=', Auth::user()->kod_organisasi)
        ->groupBy('ds_nama_sekolah','quota_L_sabk_dini','quota_P_sabk_dini','ppd')
        ->get();
        

        $data_sabk_tahfiz = DB::table('datamurids')
        ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                          SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,ds_nama_sekolah,quota_L_sabk_tahfiz,quota_P_sabk_tahfiz,ppd
        ')) 
        ->rightjoin('datasekolahs' , 'datamurids.KOD_PENEMPATAN', '=', 'kod_sekolah')
        ->where('sekolah_sabk_tahfiz','=','TAHFIZ')
        ->where('kod_ppd','=', Auth::user()->kod_organisasi)
        ->groupBy('ds_nama_sekolah','quota_L_sabk_tahfiz','quota_P_sabk_tahfiz','ppd')
        ->get();

    
     //  dd($data_kaa);

     //admin
     $data_kaa_adm = DB::table('datamurids')
     ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                       SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,ds_nama_sekolah,quota_L_kaa,quota_P_kaa,ppd,kod_ppd
     ')) 
     ->rightjoin('datasekolahs' , 'KOD_PENEMPATAN', '=', 'kod_sekolah')
     ->where('sekolah_kaa','=','KAA')
     //->where('kod_ppd','=', Auth::user()->kod_organisasi)
 
     ->groupBy('ds_nama_sekolah','quota_L_kaa','quota_P_kaa','ppd','kod_ppd')
     ->get();
     
   // dd($data_kaa );
     
     $data_sabk_dini_adm = DB::table('datamurids')
     ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                       SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,ds_nama_sekolah,quota_L_sabk_dini,quota_P_sabk_dini,ppd
     ')) 
     ->rightjoin('datasekolahs' , 'datamurids.KOD_PENEMPATAN', '=', 'kod_sekolah')
     ->where('sekolah_sabk_dini','=','DINI')
     //->where('kod_ppd','=', Auth::user()->kod_organisasi)
     ->groupBy('ds_nama_sekolah','quota_L_sabk_dini','quota_P_sabk_dini','ppd')
     ->get();
     

     $data_sabk_tahfiz_adm = DB::table('datamurids')
     ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                       SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,ds_nama_sekolah,quota_L_sabk_tahfiz,quota_P_sabk_tahfiz,ppd
     ')) 
     ->rightjoin('datasekolahs' , 'datamurids.KOD_PENEMPATAN', '=', 'kod_sekolah')
     ->where('sekolah_sabk_tahfiz','=','TAHFIZ')
     //->where('kod_ppd','=', Auth::user()->kod_organisasi)
     ->groupBy('ds_nama_sekolah','quota_L_sabk_tahfiz','quota_P_sabk_tahfiz','ppd')
     ->get();

    

  //  dd($data_kaa);

     return view('foldatasekolahs.bil_isi_sek_file',compact('data_kaa','data_sabk_dini','data_sabk_tahfiz','data_kaa_adm','data_sabk_dini_adm','data_sabk_tahfiz_adm'));
    }

    
}