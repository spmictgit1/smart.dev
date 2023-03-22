<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Response;


use App\Http\Requests\Admin\StoreDatamuridsRequest;
use App\Http\Requests\Admin\UpdateDatamuridsRequest;
use App\Datamurid;
use App\Datasekolah;
use App\Product;
class DatamuridsController extends Controller
{
    
    public function index()
   {
    $datamurids = DB::table('datamurids')->select('*');
   }

   
    public function create()
    {
        if (! Gate::allows('panel')) {
            return abort(401);
        }
        return view('datamurids.create');
    }

    
    public function store(Request $request)
    {  
        if (! Gate::allows('panel')) {
            return abort(401);
        }
        Datamurid::create($request->all());

        return redirect()->route('datamurids.index');
    }


    
    public function edit(Datamurid $datamurid)
    {  

        if (! Gate::allows('panel')) {
            return abort(401);
        }
        return view('datamurids.edit', compact('datamurid'));
    }

    
 
  public function update(Request $request, Datamurid $datamurid)
    {  
        if (! Gate::allows('panel')) {
            return abort(401);
        }
        $datamurid->update($request->all());
        return redirect()->route('datamurids.index');
    }

    public function destroy(Datamurid $datamurid)
    {  
        if (! Gate::allows('panel')) {
            return abort(401);
        }

        $datamurid->delete();

        return redirect()->route('datamurids.index');
    }
    

    public function show(Datamurid $datamurid)
    {
      
        if (! Gate::allows('panel')) {
            return abort(401);
        }

        return view('datamurids.show', compact('datamurid'));
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
 /*   public function massDestroy(Request $request)
    { 
         // dd($request);
        Datamurid::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
*/
    public function filter()
    {
     if (Auth::user()->kod_organisasi == 'jpnm') {
     $datasekolah = Datasekolah::all();
     //   if (! Gate::allows('ppd')) {
     //       return abort(401);
     //   }
        
      $sekolahrendah = DB::table('datamurids')->select('NAMA_SEKOLAH')->distinct()->get();
      $skp1 = DB::table('datamurids')->select('NAMA_SEKOLAH_P1','KOD_SEKOLAH_P1')->distinct()->get();
      $skp2 = DB::table('datamurids')->select('NAMA_SEKOLAH_P2','KOD_SEKOLAH_P2')->distinct()->get();
      $skp3 = DB::table('datamurids')->select('NAMA_SEKOLAH_P3','KOD_SEKOLAH_P3')->distinct()->get();
      
      $sekpenempatan = DB::table('datamurids')->select('KOD_PENEMPATAN','PENEMPATAN')->where('PENEMPATAN','!=','')->distinct()->get();
      
      $datamurids = DB::table('datamurids')->select('KRK_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON')->distinct()->get();
      return view('datamurids.search',compact('sekpenempatan','datasekolah','datamurids','sekolahrendah','skp1','skp2','skp3'));
         
     }
     else
     {
     $datasekolah = Datasekolah::all();
     //   if (! Gate::allows('ppd')) {
     //       return abort(401);
     //   }
        
      $sekolahrendah = DB::table('datamurids')->select('NAMA_SEKOLAH')->distinct()->get();
      $skp1 = DB::table('datamurids')->select('NAMA_SEKOLAH_P1','KOD_SEKOLAH_P1')->where('PPD_SP1','=',Auth::user()->kod_organisasi)->distinct()->get();
      $skp2 = DB::table('datamurids')->select('NAMA_SEKOLAH_P2','KOD_SEKOLAH_P2')->where('PPD_SP2','=',Auth::user()->kod_organisasi)->distinct()->get();
      $skp3 = DB::table('datamurids')->select('NAMA_SEKOLAH_P3','KOD_SEKOLAH_P3')->where('PPD_SP3','=',Auth::user()->kod_organisasi)->distinct()->get();
      
      $sekpenempatan = DB::table('datamurids')->select('KOD_PENEMPATAN','PENEMPATAN')->where('PENEMPATAN','!=','')->distinct()->get();
      
      $datamurids = DB::table('datamurids')->select('KRK_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON')->distinct()->get();
      return view('datamurids.search',compact('sekpenempatan','datasekolah','datamurids','sekolahrendah','skp1','skp2','skp3'));
     }
    }
    
 public function cari(Request $request)
    {
        //// FUNGSI TAPISAN CALON YANG BERFUNGSI.
        if (Auth::user()->kod_organisasi == 'jpnm') {
            $listsekolahpilihan_kaa = DB::table('datasekolahs')
                ->selectRaw(
                    'SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                quota_L_kaa-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                quota_P_kaa-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                quota_L_kaa,quota_P_kaa,ds_nama_sekolah,kod_sekolah,ppd',
                )
                ->leftJoin('datamurids', function ($join) {
                    $join->on('datasekolahs.kod_sekolah', '=', 'datamurids.KOD_PENEMPATAN');
                })
                ->where('sekolah_kaa', '=', 'KAA')
                ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                ->groupBy('quota_L_kaa', 'quota_P_kaa', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->get();

            $listsekolahpilihan_sabk_dini = DB::table('datasekolahs')
                ->selectRaw(
                    'SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                quota_L_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                quota_P_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                quota_L_sabk_dini,quota_P_sabk_dini,ds_nama_sekolah,kod_sekolah,ppd',
                )
                ->leftJoin('datamurids', function ($join) {
                    $join->on('datasekolahs.kod_sekolah', '=', 'datamurids.KOD_PENEMPATAN');
                })
                ->where('sekolah_sabk_dini', '=', 'DINI')
                ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                ->groupBy('quota_L_sabk_dini', 'quota_P_sabk_dini', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->get();

            $listsekolahpilihan_sabk_tahfiz = DB::table('datasekolahs')
                ->selectRaw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI')
                ->selectRaw('SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN')
                ->selectRaw('quota_L_sabk_tahfiz-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L')
                ->selectRaw('quota_P_sabk_tahfiz-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P')
                ->select('quota_L_sabk_tahfiz', 'quota_P_sabk_tahfiz', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->leftJoin('datamurids', 'datasekolahs.kod_sekolah', '=', 'datamurids.KOD_PENEMPATAN')
                ->where('sekolah_sabk_tahfiz', '=', 'TAHFIZ')
                ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                ->groupBy('quota_L_sabk_tahfiz', 'quota_P_sabk_tahfiz', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->get();

            $datasekolah = Datasekolah::all();
            /////////////////////// mula jpn
            $datamurids = Datamurid::query();

            if ($request->nokp) {
                $datamurids->where('nokp', 'LIKE', '%' . $request->nokp . '%');
            }

            if ($request->nama) {
                $datamurids->where('nama', 'LIKE', '%' . $request->nama . '%');
            }

            if ($request->pilihjantina) {
                $datamurids->where('kod_jantina', 'LIKE', '%' . $request->pilihjantina . '%');
            }

            if ($request->pilih_sek_rendah) {
                $datamurids->where('NAMA_SEKOLAH', 'LIKE', '%' . $request->pilih_sek_rendah . '%');
            }
            if ($request->pils1) {
                $datamurids->where('KOD_SEKOLAH_P1', 'LIKE', '%' . $request->pils1 . '%');
            }

            if ($request->pils2) {
                $datamurids = $datamurids->where('KOD_SEKOLAH_P2', 'LIKE', '%' . $request->pils2 . '%');
            }
            if ($request->pils3) {
                $datamurids->where('KOD_SEKOLAH_P3', 'LIKE', '%' . $request->pils3 . '%');
            }

            if ($request->pilih_tahap_sukan) {
                $datamurids = $datamurids->where('TAHAP_SUKAN', 'LIKE', '%' . $request->pilih_tahap_sukan . '%');
            }

            if ($request->p1) {
                $datamurids->where('KOD_SEKOLAH_P1', '=', $request->KOD_SEKOLAH_P1);
            }

            if ($request->p2) {
                $datamurids->where('KOD_SEKOLAH_P2', '=', $request->KOD_SEKOLAH_P2);
            }
            if ($request->p3) {
                $datamurids->where('KOD_SEKOLAH_P3', '=', $request->KOD_SEKOLAH_P3);
            }

            ///PENILAIAN PENEMPATAN
            if ($request->tp_bahasa_arab) {
                $datamurids->where('BAHASA_ARAB', 'LIKE', '%' . $request->tp_bahasa_arab . '%');
            }
            if ($request->khas_islam) {
                $datamurids->where('PERINGKAT_KHAS_ISLAM', 'LIKE', '%' . $request->khas_islam . '%');
            }
            if ($request->meritmax) {
                $datamurids->where('point', '<=', $request->meritmax);
            }
            if ($request->meritmin) {
                $datamurids->where('point', '>=', $request->meritmin);
            }

            ///STATUS PENEMPATAN//

            if ($request->sekpenempatan) {
                $datamurids->where('KOD_PENEMPATAN', 'LIKE', '%' . $request->sekpenempatan . '%');
            }
            if ($request->sudah_penempatan) {
                $datamurids->where('KOD_PENEMPATAN', '!=', '');
            }
            if ($request->belum_penempatan) {
                $datamurids->where('KOD_PENEMPATAN', '=', '');
            }

            if ($request->pemohon_rayuan) {
                $datamurids->where(function ($query) {
                    $query
                        ->whereNotNull('NAMA_SR1')
                        ->where('NAMA_SR1', '!=', 'BATAL')
                        ->where('NAMA_SR1', '!=', '')
                        ->orWhere(function ($query) {
                            $query
                                ->whereNotNull('NAMA_SR2')
                                ->where('NAMA_SR2', '!=', '')
                                ->where('NAMA_SR2', '!=', 'BATAL');
                        });
                });
            }

            $datamurids = $datamurids->orderby('point', 'desc')->paginate(4000);

            return view('datamurids.index', compact('datamurids', 'datasekolah', 'listsekolahpilihan_kaa', 'listsekolahpilihan_sabk_dini', 'listsekolahpilihan_sabk_tahfiz'));

            /////////////////////// tamat jpn
        } else {
            //JIKA PPD
            $listsekolahpilihan_kaa = DB::table('datasekolahs')
                ->select(
                    DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                     SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                     quota_L_kaa-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                     quota_P_kaa-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                     quota_L_kaa,quota_P_kaa,ds_nama_sekolah,kod_sekolah,ppd'),
                )

                ->leftjoin('datamurids', 'datasekolahs.kod_sekolah', '=', 'datamurids.KOD_PENEMPATAN')
                ->where('sekolah_kaa', '=', 'KAA')
                ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                ->groupBy('quota_L_kaa', 'quota_P_kaa', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->get();

            $listsekolahpilihan_sabk_dini = DB::table('datasekolahs')
                ->select(
                    DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                     SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                     quota_L_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                     quota_P_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                     quota_L_sabk_dini,quota_P_sabk_dini,ds_nama_sekolah,kod_sekolah,ppd'),
                )

                ->leftjoin('datamurids', 'datasekolahs.kod_sekolah', '=', 'datamurids.KOD_PENEMPATAN')
                ->where('sekolah_sabk_dini', '=', 'DINI')
                ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                ->groupBy('quota_L_sabk_dini', 'quota_P_sabk_dini', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->get();

            $listsekolahpilihan_sabk_tahfiz = DB::table('datasekolahs')
                ->select(
                    DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                     SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                     quota_L_sabk_tahfiz-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                     quota_P_sabk_tahfiz-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                     quota_L_sabk_tahfiz,quota_P_sabk_tahfiz,ds_nama_sekolah,kod_sekolah,ppd'),
                )

                ->leftjoin('datamurids', 'datasekolahs.kod_sekolah', '=', 'datamurids.KOD_PENEMPATAN')
                ->where('sekolah_sabk_tahfiz', '=', 'TAHFIZ')
                ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                ->groupBy('quota_L_sabk_tahfiz', 'quota_P_sabk_tahfiz', 'ds_nama_sekolah', 'kod_sekolah', 'ppd')
                ->get();

            $datasekolah = Datasekolah::all();

            /////////////////////// mula jpn
            $datamurids = Datamurid::query();

            if ($request->nokp) {
                $datamurids->where('nokp', 'LIKE', '%' . $request->nokp . '%');
            }

            if ($request->nama) {
                $datamurids->where('nama', 'LIKE', '%' . $request->nama . '%');
            }

            if ($request->pilihjantina) {
                $datamurids->where('kod_jantina', 'LIKE', '%' . $request->pilihjantina . '%');
            }

            if ($request->pilih_sek_rendah) {
                $datamurids->where('NAMA_SEKOLAH', 'LIKE', '%' . $request->pilih_sek_rendah . '%');
            }
            if ($request->pils1) {
                $datamurids->where('KOD_SEKOLAH_P1', 'LIKE', '%' . $request->pils1 . '%');
            }

            if ($request->pils2) {
                $datamurids = $datamurids->where('KOD_SEKOLAH_P2', 'LIKE', '%' . $request->pils2 . '%');
            }
            if ($request->pils3) {
                $datamurids->where('KOD_SEKOLAH_P3', 'LIKE', '%' . $request->pils3 . '%');
            }

            if ($request->pilih_tahap_sukan) {
                $datamurids = $datamurids->where('TAHAP_SUKAN', 'LIKE', '%' . $request->pilih_tahap_sukan . '%');
            }

            if ($request->p1) {
                $datamurids->where('KOD_SEKOLAH_P1', '=', $request->KOD_SEKOLAH_P1);
            }

            if ($request->p2) {
                $datamurids->where('KOD_SEKOLAH_P2', '=', $request->KOD_SEKOLAH_P2);
            }
            if ($request->p3) {
                $datamurids->where('KOD_SEKOLAH_P3', '=', $request->KOD_SEKOLAH_P3);
            }

            ///PENILAIAN PENEMPATAN
            if ($request->tp_bahasa_arab) {
                $datamurids->where('BAHASA_ARAB', 'LIKE', '%' . $request->tp_bahasa_arab . '%');
            }
            if ($request->khas_islam) {
                $datamurids->where('PERINGKAT_KHAS_ISLAM', 'LIKE', '%' . $request->khas_islam . '%');
            }
            if ($request->meritmax) {
                $datamurids->where('point', '<=', $request->meritmax);
            }
            if ($request->meritmin) {
                $datamurids->where('point', '>=', $request->meritmin);
            }

            ///STATUS PENEMPATAN//

            if ($request->sekpenempatan) {
                $datamurids->where('KOD_PENEMPATAN', 'LIKE', '%' . $request->sekpenempatan . '%');
            }
            if ($request->sudah_penempatan) {
                $datamurids->where('KOD_PENEMPATAN', '!=', '');
            }
            if ($request->belum_penempatan) {
                $datamurids->where('KOD_PENEMPATAN', '=', '');
            }

            if ($request->pemohon_rayuan) {
                $datamurids->where(function ($query) {
                    $query
                        ->whereNotNull('NAMA_SR1')
                        ->where('NAMA_SR1', '!=', 'BATAL')
                        ->where('NAMA_SR1', '!=', '')
                        //    ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                        ->orWhere(function ($query) {
                            $query
                                ->whereNotNull('NAMA_SR2')
                                ->where('NAMA_SR2', '!=', '')
                                //     ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
                                ->where('NAMA_SR2', '!=', 'BATAL');
                        });
                });
            }

            $datamurids = $datamurids->orderby('point', 'desc')->paginate(4000);

            return view('datamurids.index', compact('datamurids', 'datasekolah', 'listsekolahpilihan_kaa', 'listsekolahpilihan_sabk_dini', 'listsekolahpilihan_sabk_tahfiz'));

            /////////////////////// tamat jpn
        }
    }
    
 public function massUpdate(Request $request)

    { 

        if (! Gate::allows('ppd')) {
           return abort(401);
        }
       
        $pelulus = Auth::user()->name;        
        $namasekolah = request('pilihSekolah');
       
          Datamurid::whereIn('id', request('ids'))->update([
          'PENEMPATAN'=> explode(">",$namasekolah)[2],
          'ALIRAN_PENEMPATAN'=> explode(">",$namasekolah)[0], 
          'PEGAWAI_PELULUS' => $pelulus,
          'KOD_PENEMPATAN'=> explode(">",$namasekolah)[1]
          ]);
      //  return response()->noContent();
            //return redirect()->back()->with('message', 'DATA DISIMPAN');    
     
        dd($namasekolah);
    }

    public function padampenempatan()

    { 
       
          Datamurid::all()->update([
          'PENEMPATAN'=> "",
          'ALIRAN_PENEMPATAN'=> "", 
          'PEGAWAI_PELULUS' => "",
          'KOD_PENEMPATAN'=> ""])
          ;
     
            return redirect()->back()->with('message', 'DATA DISIMPAN');
     
    }


    public function row()

    { 
        if (! Gate::allows('panel')) {
            return abort(401);
        }
        $datamurids = Datamurid::paginate(20);
        return view('datamurids.rowdata', compact ('datamurids'));

        
    }

    public function simpan(Request $request)
    { 
        if (! Gate::allows('panel')) {
            return abort(401);
        }
        foreach ($request->PEGAWAI_PELULUS as $id => $pp) {

        //  dump($id);
        //  dump($pp);
          //  echo $id;  
         //  echo $pp;
         Datamurid::where('id', $id)->update(array('PEGAWAI_PELULUS' => $pp));
        }
        return response()->noContent();         
    }
    
   
    public function paparcalon(Request $request)
    { 
        
     $status = DB::table('status')->first();   

     $datamurids = DB::table('datamurids')->select('*')
     

        ->paginate(50);     
      // dd($datamurids);
      

             return view('foldatasekolahs.paparcalon', compact('status','datamurids'));
         
    }
    
/*
$datamurids =\DB::table('datamurids')->select('id','NAMA','NOKP','KOD_JANTINA','NAMA_SEKOLAH',
                           'ALAMAT_MURID','NAMA_SEKOLAH_P1','NAMA_SEKOLAH_P2','NAMA_SEKOLAH_P3',
                           'PPD_SP1','PPD_SP2','PPD_SP3','point','TAHAP_SUKAN','KOD_SEKOLAH_P1',
                           'BAHASA_ARAB','PERINGKAT_KHAS_ISLAM');





*/ 

//public function massjana(Request $request)
public function massjana()
    { 
     /*   foreach ($request->pt as $id => $P ) {
            Datamurid::where('id', $id)->update(array('point' => $P,));
           }
           return redirect()->back()->with('message', 'DATA DISIMPAN');
           */

           /*
           UPDATE menu as m1
            INNER JOIN menu as m2 ON
                m1.id = m2.id
            SET m1.jumlah = m2.darab*m2.harga
           */ 

          DB::table('datamurids as dm1')
        ->join('datamurids as dm2','dm1.id','=', 'dm2.id' )
       // ->update([ 'dm1.point' => DB::raw('dm2.id')]);XX
      // ->update([ 'dm1.point' => DB::raw('(  IFNULL(dm2.pbd,0)/ 6 * 40)+
        ->update([ 'dm1.point' => DB::raw('
        ((( IFNULL(dm2.TP_BM,0) + IFNULL(dm2.TP_BI,0) + IFNULL(dm2.TP_MATH,0) + IFNULL(dm2.TP_SAINS,0)+ IFNULL(dm2.TP_PEND_ISLAM_MORAL,0) +  IFNULL(dm2.TP_BAK,0) + 
            IFNULL(dm2.TP_SEJARAH,0) +  IFNULL(dm2.TP_RBT,0) +  IFNULL(dm2.TP_TMK,0) +  IFNULL(dm2.TP_PEND_KESIHATAN,0) +  IFNULL(dm2.TP_PEND_JASMANI,0) +  IFNULL(dm2.TP_PSV,0) +  IFNULL(dm2.TP_MUZIK,0)
            
        )/13) / 6 * 40)+
       (( IFNULL(dm2.penguasaan_jawi,0) + IFNULL(dm2.pendidikan_islam,0) + IFNULL(dm2.bahasa_arab,0)  ) / 18 * 20)+
       (( IFNULL(dm2.alquran,0) + IFNULL(dm2.amali_wuduk,0) + IFNULL(dm2.amali_solat,0) ) / 18 * 20 )  +
       
       (CASE
           WHEN dm2.PERINGKAT_KHAS_ISLAM = "Mewakili Negara" THEN 5 
           WHEN dm2.PERINGKAT_KHAS_ISLAM = "Mewakili Negeri" THEN 4 
           WHEN dm2.PERINGKAT_KHAS_ISLAM = "Mewakili Daerah/Bahagian/Zon" THEN 3 
           WHEN dm2.PERINGKAT_KHAS_ISLAM = "Mewakili Sekolah" THEN 2 
           WHEN dm2.PERINGKAT_KHAS_ISLAM = "Mewakili Rumah" THEN 1 ELSE 0 END) +
       
       (((CASE
           WHEN dm2.amalisolat = "A" THEN 4 
           WHEN dm2.amalisolat = "B" THEN 3 
           WHEN dm2.amalisolat = "C" THEN 2 
           WHEN dm2.amalisolat = "D" THEN 1 ELSE 0 END ) +
           
           (CASE
           WHEN dm2.pchi = "A" THEN 4 
           WHEN dm2.pchi = "B" THEN 3 
           WHEN dm2.pchi = "C" THEN 2 
           WHEN dm2.pchi = "D" THEN 1 ELSE 0 END)+
           
           (CASE
           WHEN dm2.baqfield78 = "A" THEN 4 
           WHEN dm2.baqfield78 = "B" THEN 3 
           WHEN dm2.baqfield78 = "C" THEN 2 
           WHEN dm2.baqfield78 = "D" THEN 1 ELSE 0 END)+
           
           (CASE
           WHEN dm2.ULUMSYARIAH = "A" THEN 4 
           WHEN dm2.ULUMSYARIAH = "B" THEN 3 
           WHEN dm2.ULUMSYARIAH = "C" THEN 2 
           WHEN dm2.ULUMSYARIAH = "D" THEN 1 ELSE 0 END) + 
           
           (CASE
           WHEN dm2.JAWIKHAT = "A" THEN 4 
           WHEN dm2.JAWIKHAT = "B" THEN 3 
           WHEN dm2.JAWIKHAT = "C" THEN 2 
           WHEN dm2.JAWIKHAT = "D" THEN 1 ELSE 0 END) + 
           
           (CASE
           WHEN dm2.SIRAH = "A" THEN 4 
           WHEN dm2.SIRAH = "B" THEN	3 
           WHEN dm2.SIRAH = "C" THEN	2 
           WHEN dm2.SIRAH = "D" THEN 1 ELSE 0 END ) + 
           
           (CASE
           WHEN dm2.ADAB = "A" THEN 4 
           WHEN dm2.ADAB = "B" THEN 3 
           WHEN dm2.ADAB = "C" THEN 2 
           WHEN dm2.ADAB = "D" THEN 1 ELSE 0 END) + 
           
           
           (CASE
           WHEN dm2.LUGHATULQURAN = "A" THEN 4 
           WHEN dm2.LUGHATULQURAN = "B" THEN 3 
           WHEN dm2.LUGHATULQURAN = "C" THEN 2 
           WHEN dm2.LUGHATULQURAN = "D" THEN 1 ELSE 0 END))/ 32 * 10 )
           
           
           
           
           ')]);
    
           return redirect()->back()->with('message', 'DATA DISIMPAN');

    }
    public function janakodppd()
    {

      

        DB::table('datamurids as dm')
        ->join('datasekolahs as ds', 'dm.KOD_SEKOLAH_P1', '=', 'ds.kod_sekolah')
        ->update([ 'dm.PPD_SP1' => DB::raw("`ds`.`kod_ppd`") ]);

        DB::table('datamurids as dm')
        ->join('datasekolahs as ds', 'dm.KOD_SEKOLAH_P2', '=', 'ds.kod_sekolah')
        ->update([ 'dm.PPD_SP2' => DB::raw("`ds`.`kod_ppd`") ]);

        DB::table('datamurids as dm')
        ->join('datasekolahs as ds', 'dm.KOD_SEKOLAH_P3', '=', 'ds.kod_sekolah')
        ->update([ 'dm.PPD_SP3' => DB::raw("`ds`.`kod_ppd`") ]);


       return redirect()->back()->with('message', 'DATA DISIMPAN');
    }
       
/*    public function janarayuan()
    {

        DB::table('datamurids as dm')
        ->join('tbrayuans as tsr', 'dm.NOKP', '=', 'tsr.NOKP')
        ->update([ 'dm.KOD_SR1' => DB::raw("`tsr`.`KOD_SR1`") ]); 

        DB::table('datamurids as dm')
        ->join('tbrayuans as tsr', 'dm.NOKP', '=', 'tsr.NOKP')
        ->update([ 'dm.KOD_SR2' => DB::raw("`tsr`.`KOD_SR2`") ]); 

        DB::table('datamurids as dm')
        ->join('tbrayuans as tsr', 'dm.NOKP', '=', 'tsr.NOKP')
        ->update([ 'dm.NAMA_SR1' => DB::raw("`tsr`.`NAMA_SR1`") ]); 

        DB::table('datamurids as dm')
        ->join('tbrayuans as tsr', 'dm.NOKP', '=', 'tsr.NOKP')
        ->update([ 'dm.NAMA_SR2' => DB::raw("`tsr`.`NAMA_SR2`") ]); 

        DB::table('datamurids as dm')
        ->join('tbrayuans as tsr', 'dm.NOKP', '=', 'tsr.NOKP')
        ->update([ 'dm.SEDIA' => DB::raw("`tsr`.`SEDIA`") ]); 

       return redirect()->back()->with('message', 'DATA DISIMPAN');
    }   */
    
    public function janarayuan()
    {
        DB::table('datamurids as dm')
            ->join('tbrayuans as tsr', 'dm.NOKP', '=', 'tsr.NOKP')
            ->update([
                'dm.KOD_SR1' => DB::raw('IFNULL(`tsr`.`KOD_SR1`, "")'),
                'dm.KOD_SR2' => DB::raw('IFNULL(`tsr`.`KOD_SR2`, "")'),
                'dm.NAMA_SR1' => DB::raw('IFNULL(`tsr`.`NAMA_SR1`, "")'),
                'dm.NAMA_SR2' => DB::raw('IFNULL(`tsr`.`NAMA_SR2`, "")'),
                'dm.SEDIA' => DB::raw('IFNULL(`tsr`.`SEDIA`, "")')
            ]);
    
        return redirect()
            ->back()
            ->with('message', 'DATA DISIMPAN');
    }

    public function downloadData()
    {
        $data = DB::table('datamurids')
                    ->select('NAMA', 'NOKP', 'KOD_SR1', 'KOD_SR2', 'NAMA_SR1', 'NAMA_SR2','SEDIA')
                    ->where('KOD_SR1', '!=', '')
                    ->where('KOD_SR2', '!=', '')
                    ->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=data.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
    
        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array('NAME', 'NOKP','KOD_SR1','KOD_SR2','NAMA_SR1','NAMA_SR2','SEDIA'));
    
            foreach ($data as $row) {
                fputcsv($file, array($row->NAMA, $row->NOKP, $row->KOD_SR1, $row->KOD_SR2, $row->NAMA_SR1, $row->NAMA_SR2, $row->SEDIA));
            }
            fclose($file);
        };
    
       
        return Response::stream($callback, 200, $headers);
    }

     public function uploadCSV(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            $NOKP = $record['NOKP'];

            // Check if the record already exists in the database
            if (Datamurid::where('NOKP', $NOKP)->exists()) {
                continue; // Skip the record if it already exists
            }
            if (!preg_match('/^[0-9]{12}$/', $NOKP)) {
                //  continue; // Skip the record if it's not a 12 digit number
                return redirect()
                    ->back()
                    ->with('message', 'SILA SEMAK, PASTIKAN NO KAD PENGENALAN ANDA 12 DIGIT');
            }

            // Insert the record into the database
            DB::table('datamurids')->insert([
                //  'NOKP' => $record['NOKP'],
                // 'NAMA' => $record['NAMA'],
                // 'id' => $record['id'],
                'IDMURID' => $record['IDMURID'],
                'NOKP' => $record['NOKP'],
                'NAMA' => $record['NAMA'],
                'KOD_JANTINA' => $record['KOD_JANTINA'],
                'KAUM' => $record['KAUM'],
                'AGAMA' => $record['AGAMA'],
                'WARGANEGARA_MURID' => $record['WARGANEGARA_MURID'],
                'KOD_SEKOLAH_RENDAH' => $record['KOD_SEKOLAH_RENDAH'],
                'NAMA_SEKOLAH' => $record['NAMA_SEKOLAH'],
                'LOKASI_SEKOLAH_RENDAH' => $record['LOKASI_SEKOLAH_RENDAH'],
                'UNIT_BERUNIFORM' => $record['UNIT_BERUNIFORM'],
                'JAWATAN_BERUNIFORM' => $record['JAWATAN_BERUNIFORM'],
                'NAMA_KELAB' => $record['NAMA_KELAB'],
                'JAWATAN_KELAB' => $record['JAWATAN_KELAB'],
                'NAMA_SUKAN' => $record['NAMA_SUKAN'],
                'TAHAP_SUKAN' => $record['TAHAP_SUKAN'],
                'NAMA_SUKAN_2' => $record['NAMA_SUKAN_2'],
                'TAHAP_SUKAN_2' => $record['TAHAP_SUKAN_2'],
                'CAPAIAN_KHAS_ISLAM' => $record['CAPAIAN_KHAS_ISLAM'],
                'PERINGKAT_KHAS_ISLAM' => $record['PERINGKAT_KHAS_ISLAM'],
                'KEPIMPINAN' => $record['KEPIMPINAN'],
                'NAMA_BAPA' => $record['NAMA_BAPA'],
                'NO_KP_BAPA' => $record['NO_KP_BAPA'],
                'WARGANEGARA_BAPA' => $record['WARGANEGARA_BAPA'],
                'KERJA_BAPA' => $record['KERJA_BAPA'],
                'GAJI_BAPA' => $record['GAJI_BAPA'],
                'NO_TEL_BAPA' => $record['NO_TEL_BAPA'],
                'TANGGUNGAN' => $record['TANGGUNGAN'],
                'NAMA_IBU' => $record['NAMA_IBU'],
                'NO_KP_IBU' => $record['NO_KP_IBU'],
                'WARGANEGARA_IBU' => $record['WARGANEGARA_IBU'],
                'KERJA_IBU' => $record['KERJA_IBU'],
                'GAJI_IBU' => $record['GAJI_IBU'],
                'NO_TEL_IBU' => $record['NO_TEL_IBU'],
                'ALAMAT_MURID' => $record['ALAMAT_MURID'],
                'BANDAR' => $record['BANDAR'],
                'POSKOD' => $record['POSKOD'],
                'NEGERI' => $record['NEGERI'],
                'KODSEKOLAH_MEN_LULUS' => $record['KODSEKOLAH_MEN_LULUS'],
                'NAMA_SEKOLAH_MEN_LULUS' => $record['NAMA_SEKOLAH_MEN_LULUS'],
                'SenaraNamaMurid_NAMA_SEK_DIPOHON' => $record['SenaraNamaMurid_NAMA_SEK_DIPOHON'],
                'SenaraNamaMurid_KOD_SEK_DIPOHON' => $record['SenaraNamaMurid_KOD_SEK_DIPOHON'],
                'SenaraNamaMurid_PILIHAN_1' => $record['SenaraNamaMurid_PILIHAN_1'],
                'SenaraNamaMurid_PILIHAN_2' => $record['SenaraNamaMurid_PILIHAN_2'],
                'SenaraNamaMurid_PILIHAN_3' => $record['SenaraNamaMurid_PILIHAN_3'],
                'PILIHAN_4' => $record['PILIHAN_4'],
                'SETUJU_SEKOLAH_LAIN' => $record['SETUJU_SEKOLAH_LAIN'],
                'AMBIL_AGAMA' => $record['AMBIL_AGAMA'],
                'AMBILJQAF' => $record['AMBILJQAF'],
                'ALQURAN' => $record['ALQURAN'],
                'PENGUASAAN_JAWI' => $record['PENGUASAAN_JAWI'],
                'AMALI_WUDUK' => $record['AMALI_WUDUK'],
                'AMALI_SOLAT' => $record['AMALI_SOLAT'],
                'PENDIDIKAN_ISLAM' => $record['PENDIDIKAN_ISLAM'],
                'BAHASA_ARAB' => $record['BAHASA_ARAB'],
                'AMBILKAFA' => $record['AMBILKAFA'],
                'TP_BM' => $record['TP_BM'],
                'TP_BI' => $record['TP_BI'],
                'TP_MATH' => $record['TP_MATH'],
                'TP_SAINS' => $record['TP_SAINS'],
                'TP_PEND_ISLAM_MORAL' => $record['TP_PEND_ISLAM_MORAL'],
                'TP_BAK' => $record['TP_BAK'],
                'TP_SEJARAH' => $record['TP_SEJARAH'],
                'TP_RBT' => $record['TP_RBT'],
                'TP_TMK' => $record['TP_TMK'],
                'TP_PEND_KESIHATAN' => $record['TP_PEND_KESIHATAN'],
                'TP_PEND_JASMANI' => $record['TP_PEND_JASMANI'],
                'TP_PSV' => $record['TP_PSV'],
                'TP_MUZIK' => $record['TP_MUZIK'],
                'AGILIRUPKK' => $record['AGILIRUPKK'],
                'AMALISOLAT' => $record['AMALISOLAT'],
                'AMALISOLAT_M' => $record['AMALISOLAT_M'],
                'PCHI' => $record['PCHI'],
                'PCHI_M' => $record['PCHI_M'],
                'baqfield78' => $record['baqfield78'],
                'ALQURAN_M' => $record['ALQURAN_M'],
                'ULUMSYARIAH' => $record['ULUMSYARIAH'],
                'ULUMSYARIAH_M' => $record['ULUMSYARIAH_M'],
                'JAWIKHAT' => $record['JAWIKHAT'],
                'JAWIKHAT_M' => $record['JAWIKHAT_M'],
                'SIRAH' => $record['SIRAH'],
                'SIRAH_M' => $record['SIRAH_M'],
                'ADAB' => $record['ADAB'],
                'ADAB_M' => $record['ADAB_M'],
                'LUGHATULQURAN' => $record['LUGHATULQURAN'],
                'LUGHATULQURAN_M' => $record['LUGHATULQURAN_M'],
                'DISAHKAN' => $record['DISAHKAN'],
                'TXTTARIKHSERAHGB' => $record['TXTTARIKHSERAHGB'],
                'MARKAH10' => $record['MARKAH10'],
                'MARKAH100' => $record['MARKAH100'],
                'GRED' => $record['GRED'],
                'BMI_P2' => $record['BMI_P2'],
                'TAKSIRAN_P2' => $record['TAKSIRAN_P2'],
                'GRED_P2' => $record['GRED_P2'],
                'VERBALLINGUISTIK' => $record['VERBALLINGUISTIK'],
                'LOGIKMATEMATIK' => $record['LOGIKMATEMATIK'],
                'VISUALRUANG' => $record['VISUALRUANG'],
                'MUZIK' => $record['MUZIK'],
                'NATURALIS' => $record['NATURALIS'],
                'INTRAPERSONAL' => $record['INTRAPERSONAL'],
                'INTERPERSONAL' => $record['INTERPERSONAL'],
                'KINESTETIK' => $record['KINESTETIK'],
                'EKSISTENSIAL' => $record['EKSISTENSIAL'],
                'SPILISANGRED' => $record['SPILISANGRED'],
                'SPILISANMARKAH' => $record['SPILISANMARKAH'],
                'SPIHAFAZANGRED' => $record['SPIHAFAZANGRED'],
                'SPIHAFAZANMARKAH' => $record['SPIHAFAZANMARKAH'],
                'SPIPIGRED' => $record['SPIPIGRED'],
                'SPIPIMARKAH' => $record['SPIPIMARKAH'],
                'SPIPJGRED' => $record['SPIPJGRED'],
                'SPIPJMARKAH' => $record['SPIPJMARKAH'],
                'SPIQHGRED' => $record['SPIQHGRED'],
                'SPIQHMARKAH' => $record['SPIQHMARKAH'],
                'PILIHAN_1' => $record['PILIHAN_1'],
                'KOD_SEKOLAH_P1' => $record['KOD_SEKOLAH_P1'],
                'NAMA_SEKOLAH_P1' => $record['NAMA_SEKOLAH_P1'],
                'PILIHAN_2' => $record['PILIHAN_2'],
                'KOD_SEKOLAH_P2' => $record['KOD_SEKOLAH_P2'],
                'NAMA_SEKOLAH_P2' => $record['NAMA_SEKOLAH_P2'],
                'PILIHAN_3' => $record['PILIHAN_3'],
                'KOD_SEKOLAH_P3' => $record['KOD_SEKOLAH_P3'],
                'NAMA_SEKOLAH_P3' => $record['NAMA_SEKOLAH_P3'],
                'UPKK' => $record['UPKK'],
                'SIA' => $record['SIA'],
                'BA_SIA' => $record['BA_SIA'],
                'PSJ' => $record['PSJ'],
                'PMAA' => $record['PMAA'],
                'NAMA_SEKOLAH_P4' => $record['NAMA_SEKOLAH_P4'],
                'KOD_PENEMPATAN' => $record['KOD_PENEMPATAN'],
                'pajsk' => $record['pajsk'],
                'PENEMPATAN' => $record['PENEMPATAN'],
                'ALIRAN_PENEMPATAN' => $record['ALIRAN_PENEMPATAN'],
                'KRK_NAMA_SEK_DIPOHON' => $record['KRK_NAMA_SEK_DIPOHON'],
                'KAA_NAMA_SEK_DIPOHON' => $record['KAA_NAMA_SEK_DIPOHON'],
                'SABK_NAMA_SEK_DIPOHON' => $record['SABK_NAMA_SEK_DIPOHON'],
                'PEGAWAI_PELULUS' => $record['PEGAWAI_PELULUS'],
                'point_SALAH' => $record['point_SALAH'],
                'rayuan' => $record['rayuan'],
                //'updated_at' => $record['updated_at'],
                //  'created_at' => $record['created_at'],
                'sahterima' => $record['sahterima'],
                'point' => $record['point'],
                'PPD_SP1' => $record['PPD_SP1'],
                'PPD_SP2' => $record['PPD_SP2'],
                'PPD_SP3' => $record['PPD_SP3'],
                'pbd' => $record['pbd'],
                'STATUS_R' => $record['STATUS_R'],
                'CATATAN_R' => $record['CATATAN_R'],
                'f115' => $record['f115'],
                'f116' => $record['f116'],
                'f117' => $record['f117'],
                'KOD_SR1' => $record['KOD_SR1'],
                'KOD_SR2' => $record['KOD_SR2'],
                'NAMA_SR1' => $record['NAMA_SR1'],
                'NAMA_SR2' => $record['NAMA_SR2'],
                'SEDIA' => $record['SEDIA'],

                // Add more columns as needed
            ]);
        }

        return redirect()
            ->back()
            ->with('message', 'DATA TELAH BERJAYA DISIMPAN');
    }
    
   
}
