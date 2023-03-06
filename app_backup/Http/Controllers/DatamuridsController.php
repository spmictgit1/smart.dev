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
use App\Product;
class DatamuridsController extends Controller
{
    
    public function index()
    {
       // if (! Gate::allows('ppd')) {
       ///     return abort(401);
      //  }
        
        $listsekolahpilihan = Datasekolah::all();

       $listsekolahpilihan_kaa = DB::table('datasekolahs')
       ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                         SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                         quota_L_kaa-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                         quota_P_kaa-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                         quota_L_kaa,quota_P_kaa,ds_nama_sekolah,kod_sekolah,ppd')) 

       ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
       ->where('sekolah_kaa','=','KAA')
       ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
       ->groupBy('quota_L_kaa','quota_P_kaa','ds_nama_sekolah','kod_sekolah','ppd')
       ->get();
       
      // dd($listsekolahpilihan_kaa);
       $listsekolahpilihan_sabk_dini = DB::table('datasekolahs')
       ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                         SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                         quota_L_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                         quota_P_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                         quota_L_sabk_dini,quota_P_sabk_dini,ds_nama_sekolah,kod_sekolah,ppd')) 

        ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
       ->where('sekolah_sabk_dini','=','DINI')
       ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
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
       ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
       ->groupBy('quota_L_sabk_tahfiz','quota_P_sabk_tahfiz','ds_nama_sekolah','kod_sekolah','ppd')
       ->get();
       
//dd(Auth::user()->kod_organisasi);
//dd($listsekolahpilihan_kaa);
//dd($listsekolahpilihan_sabk_dini);
//dd($listsekolahpilihan_sabk_tahfiz);


//        $alldatamurid = Datamurid::all();
     //   $datamurids = Datamurid::paginate(100);      //SINI UBAH PERPAGE BARU 
 //    $datamuridsx = DB::table('datamurids')
 //    ->select('*') 
  //   ->limit(100)
 //    ->get();   
///////////////////MARKAH TAMBAHAN////////
$datamurids = DB::table('datamurids')
   
->select(DB::raw('sum(pbd/6*40)
                +
                  ((penguasaan_jawi + pendidikan_islam +
                  bahasa_arab)/18*20)+
                  ((alquran + amali_wuduk +amali_solat)/18*20)+
                  (SUM(CASE 
                WHEN amalisolat = "A" THEN 4 
                WHEN amalisolat = "B" THEN 3                         
                WHEN amalisolat = "C" THEN 2 
                WHEN amalisolat = "D" THEN 1                                               
                ELSE 0 END) +

                (SUM(CASE 
                WHEN pchi = "A" THEN 4 
                WHEN pchi = "B" THEN 3                         
                WHEN pchi = "C" THEN 2 
                WHEN pchi = "D" THEN 1                                               
                ELSE 0 END) +
                
                SUM(CASE 
                WHEN baqfield78 = "A" THEN 4 
                WHEN baqfield78 = "B" THEN 3                         
                WHEN baqfield78 = "C" THEN 2 
                WHEN baqfield78 = "D" THEN 1                                               
                ELSE 0 END) +

                SUM(CASE 
                WHEN ULUMSYARIAH = "A" THEN 4 
                WHEN ULUMSYARIAH = "B" THEN 3                         
                WHEN ULUMSYARIAH = "C" THEN 2 
                WHEN ULUMSYARIAH = "D" THEN 1                                               
                ELSE 0 END) +

                SUM(CASE 
                WHEN JAWIKHAT = "A" THEN 4 
                WHEN JAWIKHAT = "B" THEN 3                         
                WHEN JAWIKHAT = "C" THEN 2 
                WHEN JAWIKHAT = "D" THEN 1                                               
                ELSE 0 END) +

                SUM(CASE 
                WHEN SIRAH = "A" THEN 4 
                WHEN SIRAH = "B" THEN 3                         
                WHEN SIRAH = "C" THEN 2 
                WHEN SIRAH = "D" THEN 1                                               
                ELSE 0 END) +

                SUM(CASE 
                WHEN ADAB = "A" THEN 4 
                WHEN ADAB = "B" THEN 3                         
                WHEN ADAB = "C" THEN 2 
                WHEN ADAB = "D" THEN 1                                               
                ELSE 0 END) +

                SUM(CASE 
                WHEN LUGHATULQURAN = "A" THEN 4 
                WHEN LUGHATULQURAN = "B" THEN 3                         
                WHEN LUGHATULQURAN = "C" THEN 2 
                WHEN LUGHATULQURAN = "D" THEN 1                                               
                ELSE 0 END))/32*10)+

                (SUM(CASE 
                WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negara" THEN 5 
                WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negeri" THEN 4                         
                WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Daerah/Bahagian/Zon" THEN 3 
                WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Sekolah" THEN 2 
                WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Rumah" THEN 1                                             
                ELSE 0 END) 
                )   
                as jumlah,

                (CASE 
                WHEN KOD_SEKOLAH_P1 IN 
                ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                THEN "M010"
                WHEN KOD_SEKOLAH_P1 IN 
                ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                THEN "M030"
                
                WHEN KOD_SEKOLAH_P1 IN 
                ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                )
                THEN "M020"

                ELSE "" END) as KOD_PPD_SP1,



                (CASE 
                WHEN KOD_SEKOLAH_P2 IN 
                ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                THEN "M010"
                WHEN KOD_SEKOLAH_P2 IN 
                ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                THEN "M030"
                
                WHEN KOD_SEKOLAH_P2 IN 
                ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                )
                THEN "M020"

                ELSE "" END) as KOD_PPD_SP2,

                (CASE 
                WHEN KOD_SEKOLAH_P3 IN 
                ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                THEN "M010"
                WHEN KOD_SEKOLAH_P3 IN 
                ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                THEN "M030"
                
                WHEN KOD_SEKOLAH_P3 IN 
                ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                )
                THEN "M020"

                ELSE "" END) as KOD_PPD_SP3,

                 NAMA,NOKP,PENEMPATAN,ALIRAN_PENEMPATAN,
                 NAMA_SEKOLAH_P1,NAMA_SEKOLAH_P2,NAMA_SEKOLAH_P3,
                 PILIHAN_1,PILIHAN_2,PILIHAN_3,NAMA_SEKOLAH_MEN_LULUS,id,KOD_JANTINA,point                   
                '))


->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
          'NAMA_SEKOLAH_P1','NAMA_SEKOLAH_P2','NAMA_SEKOLAH_P3',
          'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
          'pbd','penguasaan_jawi','pendidikan_islam',
          'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
          'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
          )
->having('PPD_SP1','=', Auth::user()->kod_organisasi)
//->orhaving('KOD_PPD_SP2','=', Auth::user()->kod_organisasi)
//->orhaving('KOD_PPD_SP3','=', Auth::user()->kod_organisasi)  
//->orderBy('jumlah','ASC')         
//->limit(20)
->get();
        
  //dd($datamurids);
        return view('datamurids.index', compact('datamurids','listsekolahpilihan','listsekolahpilihan_kaa','listsekolahpilihan_sabk_dini','listsekolahpilihan_sabk_tahfiz'));
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
    { $datasekolah = Datasekolah::all();
        if (! Gate::allows('ppd')) {
            return abort(401);
        }
        
      $sekolahrendah = DB::table('datamurids')->whereNotNull('NAMA_SEKOLAH')->distinct()->get();
      $skp1 = DB::table('datamurids')->select('NAMA_SEKOLAH_P1','KOD_SEKOLAH_P1')->where('PPD_SP1','=',Auth::user()->kod_organisasi)->distinct()->get();
      $skp2 = DB::table('datamurids')->select('NAMA_SEKOLAH_P2','KOD_SEKOLAH_P2')->where('PPD_SP2','=',Auth::user()->kod_organisasi)->distinct()->get();
      $skp3 = DB::table('datamurids')->select('NAMA_SEKOLAH_P3','KOD_SEKOLAH_P3')->where('PPD_SP3','=',Auth::user()->kod_organisasi)->distinct()->get();

          $datamurids = DB::table('datamurids')->select('KRK_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON')->distinct()->get();

        return view('datamurids.search',compact('datasekolah','datamurids','sekolahrendah','skp1','skp2','skp3'));
    }
    
    public function cari(Request $request)
{   
    if (! Gate::allows('ppd')) {
        return abort(401);
    }
   // dd($request); 

 //  $listsekolahpilihan = Datasekolah::all();

   $listsekolahpilihan_kaa = DB::table('datasekolahs')
   ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                     SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                     quota_L_kaa-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                     quota_P_kaa-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                     quota_L_kaa,quota_P_kaa,ds_nama_sekolah,kod_sekolah,ppd')) 

   ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
   ->where('sekolah_kaa','=','KAA')
   ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
   ->groupBy('quota_L_kaa','quota_P_kaa','ds_nama_sekolah','kod_sekolah','ppd')
   ->get();
   
  // dd($listsekolahpilihan_kaa);
   $listsekolahpilihan_sabk_dini = DB::table('datasekolahs')
   ->select(DB::raw('SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as JUM_LELAKI,
                     SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as JUM_PEREMPUAN,
                     quota_L_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "L" THEN 1 ELSE 0 END) as BEZA_L,
                     quota_P_sabk_dini-SUM(CASE WHEN KOD_JANTINA = "P" THEN 1 ELSE 0 END) as BEZA_P,
                     quota_L_sabk_dini,quota_P_sabk_dini,ds_nama_sekolah,kod_sekolah,ppd')) 

    ->leftjoin('datamurids','datasekolahs.kod_sekolah' ,'=', 'datamurids.KOD_PENEMPATAN')
   ->where('sekolah_sabk_dini','=','DINI')
   ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
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
   ->where('kod_ppd', '=', Auth::user()->kod_organisasi)
   ->groupBy('quota_L_sabk_tahfiz','quota_P_sabk_tahfiz','ds_nama_sekolah','kod_sekolah','ppd')
   ->get();

 //   $alldatamurid = Datamurid::all();
 //   $datamurids = Datamurid::paginate(100);      //SINI UBAH PERPAGE BARU 
 //$datamuridsx = DB::table('datamurids')
 //->select('*') 
 //->limit(100)
 //->get();   


  //  $alldatamurid = Datamurid::all();
    $datasekolah = Datasekolah::all();
    $datamurids =\DB::table('datamurids')->select('*',DB::raw('
                  (CASE 
                  WHEN KOD_SEKOLAH_P1 IN 
                  ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                  "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                  THEN "M010"
                  WHEN KOD_SEKOLAH_P1 IN 
                  ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                  "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                  THEN "M030"
                  
                  WHEN KOD_SEKOLAH_P1 IN 
                  ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                  "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                  "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                  "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                  "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                  )
                  THEN "M020"
  
                  ELSE "" END) as KOD_PPD_SP1,
  
  
  
                  (CASE 
                  WHEN KOD_SEKOLAH_P2 IN 
                  ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                  "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                  THEN "M010"
                  WHEN KOD_SEKOLAH_P2 IN 
                  ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                  "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                  THEN "M030"
                  
                  WHEN KOD_SEKOLAH_P2 IN 
                  ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                  "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                  "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                  "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                  "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                  )
                  THEN "M020"
  
                  ELSE "" END) as KOD_PPD_SP2,
  
                  (CASE 
                  WHEN KOD_SEKOLAH_P3 IN 
                  ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                  "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                  THEN "M010"
                  WHEN KOD_SEKOLAH_P3 IN 
                  ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                  "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                  THEN "M030"
                  
                  WHEN KOD_SEKOLAH_P3 IN 
                  ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                  "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                  "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                  "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                  "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                  )
                  THEN "M020"
  
                  ELSE "" END) as KOD_PPD_SP3
                '))
                
->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
          'NAMA_SEKOLAH_P1','NAMA_SEKOLAH_P2','NAMA_SEKOLAH_P3',
          'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
          'pbd','penguasaan_jawi','pendidikan_islam',
          'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
          'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
)    ;  
//->having('PPD_DM_KOD', '=', Auth::user()->kod_organisasi);
//->having('PPD_SP1','=', Auth::user()->kod_organisasi)
//->orhaving('PPD_SP2','=', Auth::user()->kod_organisasi)
//->orhaving('PPD_SP3','=', Auth::user()->kod_organisasi) ;


    if( $request->nokp){
        $datamurids = $datamurids->where('nokp', 'LIKE', "%" . $request->nokp . "%");
    }
    if( $request->nama){
        $datamurids = $datamurids->where('nama', 'LIKE', "%" . $request->nama . "%");
    }
   if( $request->pilihjantina){
        $datamurids = $datamurids->where('kod_jantina', 'LIKE', "%" . $request->pilihjantina . "%");
    }
    
    if( $request->pilih_sek_rendah){
        $datamurids = $datamurids->where('NAMA_SEKOLAH', 'LIKE', "%" . $request->pilih_sek_rendah . "%");
    }
    if( $request->pils1){
        $datamurids = $datamurids->where('KOD_SEKOLAH_P1', 'LIKE', "%" . $request->pils1 . "%");
    }
    
    if( $request->pils2){
        $datamurids = $datamurids->where('KOD_SEKOLAH_P2', 'LIKE', "%" . $request->pils2 . "%");
    }
    if( $request->pils3){
        $datamurids = $datamurids->where('KOD_SEKOLAH_P3', 'LIKE', "%" . $request->pils3 . "%");
    }


    if( $request->pilih_tahap_sukan){
        $datamurids = $datamurids->where('TAHAP_SUKAN', 'LIKE', "%" . $request->pilih_tahap_sukan . "%");
    }
    if( $request->p1){
        $datamurids = $datamurids->whereNotNull('KOD_SEKOLAH_P1');
    }
    ///PENILAIAN PENEMPATAN
    if( $request->tp_bahasa_arab){
        $datamurids = $datamurids->where('BAHASA_ARAB', 'LIKE', "%" . $request->tp_bahasa_arab . "%");
    }
    if( $request->khas_islam){
            $datamurids = $datamurids->where('PERINGKAT_KHAS_ISLAM', 'LIKE', "%" . $request->khas_islam . "%");
    }
    ///STATUS PENEMPATAN//

    if( $request->sudah_penempatan){
       // $datamurids = $datamurids->whereNotNull('KOD_PENEMPATAN');
       $datamurids = $datamurids->whereNotNull('KOD_PENEMPATAN');
    }
    if( $request->belum_penempatan){
        $datamurids = $datamurids->whereNull('KOD_PENEMPATAN');
    }
    //dd($datamuridsx);
    
  /*  if( $request->pilih_sek_rendah){
        $data = $data->where('nama_sekolah', 'LIKE', "%" . $request->pilih_sek_rendah . "%");
    }*/
    $datamurids = $datamurids
    ->get();
   return view('datamurids.index', compact('datamurids','datasekolah','listsekolahpilihan_kaa','listsekolahpilihan_sabk_dini','listsekolahpilihan_sabk_tahfiz'));
   
 }

 public function massUpdate(Request $request)

    { //  dd($request);

        if (! Gate::allows('ppd')) {
           return abort(401);
        }
       
        $pelulus = Auth::user()->name;        
        $namasekolah = request('pilihSekolah');
       
          Datamurid::whereIn('id', request('ids'))->update(['PENEMPATAN'=> explode(">",$namasekolah)[2],
          'ALIRAN_PENEMPATAN'=> explode(">",$namasekolah)[0], 
          'PEGAWAI_PELULUS' => $pelulus,
          'KOD_PENEMPATAN'=> explode(">",$namasekolah)[1]])
          ;

          
        return response()->noContent();
     //  return redirect()->back()->with('message', 'DATA DISIMPAN');
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
        
            // if (! Gate::allows('ppd')) {
            ///     return abort(401);
           //  }
     $datamurids = DB::table('datamurids')
        
     ->select(DB::raw('sum(pbd/6*40)
                     +
                       ((penguasaan_jawi + pendidikan_islam +
                       bahasa_arab)/18*20)+
                       ((alquran + amali_wuduk +amali_solat)/18*20)+
                       (SUM(CASE 
                     WHEN amalisolat = "A" THEN 4 
                     WHEN amalisolat = "B" THEN 3                         
                     WHEN amalisolat = "C" THEN 2 
                     WHEN amalisolat = "D" THEN 1                                               
                     ELSE 0 END) +
     
                     (SUM(CASE 
                     WHEN pchi = "A" THEN 4 
                     WHEN pchi = "B" THEN 3                         
                     WHEN pchi = "C" THEN 2 
                     WHEN pchi = "D" THEN 1                                               
                     ELSE 0 END) +
                     
                     SUM(CASE 
                     WHEN baqfield78 = "A" THEN 4 
                     WHEN baqfield78 = "B" THEN 3                         
                     WHEN baqfield78 = "C" THEN 2 
                     WHEN baqfield78 = "D" THEN 1                                               
                     ELSE 0 END) +
     
                     SUM(CASE 
                     WHEN ULUMSYARIAH = "A" THEN 4 
                     WHEN ULUMSYARIAH = "B" THEN 3                         
                     WHEN ULUMSYARIAH = "C" THEN 2 
                     WHEN ULUMSYARIAH = "D" THEN 1                                               
                     ELSE 0 END) +
     
                     SUM(CASE 
                     WHEN JAWIKHAT = "A" THEN 4 
                     WHEN JAWIKHAT = "B" THEN 3                         
                     WHEN JAWIKHAT = "C" THEN 2 
                     WHEN JAWIKHAT = "D" THEN 1                                               
                     ELSE 0 END) +
     
                     SUM(CASE 
                     WHEN SIRAH = "A" THEN 4 
                     WHEN SIRAH = "B" THEN 3                         
                     WHEN SIRAH = "C" THEN 2 
                     WHEN SIRAH = "D" THEN 1                                               
                     ELSE 0 END) +
     
                     SUM(CASE 
                     WHEN ADAB = "A" THEN 4 
                     WHEN ADAB = "B" THEN 3                         
                     WHEN ADAB = "C" THEN 2 
                     WHEN ADAB = "D" THEN 1                                               
                     ELSE 0 END) +
     
                     SUM(CASE 
                     WHEN LUGHATULQURAN = "A" THEN 4 
                     WHEN LUGHATULQURAN = "B" THEN 3                         
                     WHEN LUGHATULQURAN = "C" THEN 2 
                     WHEN LUGHATULQURAN = "D" THEN 1                                               
                     ELSE 0 END))/32*10)+
     
                     (SUM(CASE 
                     WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negara" THEN 5 
                     WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negeri" THEN 4                         
                     WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Daerah/Bahagian/Zon" THEN 3 
                     WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Sekolah" THEN 2 
                     WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Rumah" THEN 1                                             
                     ELSE 0 END) 
                     )   
                     as jumlah,
     
                     (CASE 
                     WHEN KOD_SEKOLAH_P1 IN 
                     ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                     "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                     THEN "M010"
                     WHEN KOD_SEKOLAH_P1 IN 
                     ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                     "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                     THEN "M030"
                     
                     WHEN KOD_SEKOLAH_P1 IN 
                     ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                     "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                     "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                     "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                     "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                     )
                     THEN "M020"
     
                     ELSE "" END) as KOD_PPD_SP1,
     
     
     
                     (CASE 
                     WHEN KOD_SEKOLAH_P2 IN 
                     ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                     "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                     THEN "M010"
                     WHEN KOD_SEKOLAH_P2 IN 
                     ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                     "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                     THEN "M030"
                     
                     WHEN KOD_SEKOLAH_P2 IN 
                     ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                     "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                     "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                     "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                     "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                     )
                     THEN "M020"
     
                     ELSE "" END) as KOD_PPD_SP2,
     
                     (CASE 
                     WHEN KOD_SEKOLAH_P3 IN 
                     ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                     "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                     THEN "M010"
                     WHEN KOD_SEKOLAH_P3 IN 
                     ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                     "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                     THEN "M030"
                     
                     WHEN KOD_SEKOLAH_P3 IN 
                     ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                     "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                     "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                     "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                     "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                     )
                     THEN "M020"
     
                     ELSE "" END) as KOD_PPD_SP3,
     
                      NAMA,NOKP,PENEMPATAN,ALIRAN_PENEMPATAN,
                      NAMA_SEKOLAH_P1,NAMA_SEKOLAH_P2,NAMA_SEKOLAH_P3,
                      PILIHAN_1,PILIHAN_2,PILIHAN_3,NAMA_SEKOLAH_MEN_LULUS,id,KOD_JANTINA,point,PPD_SP1,PPD_SP2,PPD_SP3                    
                     '))
     
     
     ->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
               'NAMA_SEKOLAH_P1','NAMA_SEKOLAH_P2','NAMA_SEKOLAH_P3',
               'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
               'pbd','penguasaan_jawi','pendidikan_islam',
               'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
               'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
               )
     //->limit(50)
     //->get();
        ->paginate(400);     
      // dd($datamurids);
      

             return view('foldatasekolahs.paparcalon', compact('datamurids'));
         
    }


//public function massjana(Request $request)
public function massjana()
    { //  dd($request);
/*
          Datamurid::whereIn('id', request('ids'))->update(['PENEMPATAN'=> explode(">",$namasekolah)[2],
          'ALIRAN_PENEMPATAN'=> explode(">",$namasekolah)[0], 
          'PEGAWAI_PELULUS' => $pelulus,
          'KOD_PENEMPATAN'=> explode(">",$namasekolah)[1]])
          ;
         */
       
        foreach ($request->pt as $id => $P ) {
            Datamurid::where('id', $id)->update(array('point' => $P,));
           }
        
           return redirect()->back()->with('message', 'DATA DISIMPAN');
        
    //   $datamurids =  $this->test();
    //    dd($datamurids);
    //    DB::table('datamurids as e')
         
     //    ->update(['e.point' => DB::raw('e.id')]);

    //    return redirect()->back()->with('message', 'DATA DISIMPAN');

      /*     $datamurids = $this->kirajumlah();
           dd($datamurids->jumlah);
         DB::table('datamurids')
         ->update(['point' => DB::raw('pbd/6*40+((penguasaan_jawi + pendidikan_islam +
         bahasa_arab)/18*20)
         
         
         
         
         
         ')]); */
    
         //  return redirect()->back()->with('message', 'DATA DISIMPAN');


    }

        public function kirajumlah()
        {
            
                
                    // if (! Gate::allows('ppd')) {
                    ///     return abort(401);
                   //  }
             $datamurids = DB::table('datamurids')
                
             ->select(DB::raw('sum(pbd/6*40)
                             +
                               ((penguasaan_jawi + pendidikan_islam +
                               bahasa_arab)/18*20)+
                               ((alquran + amali_wuduk +amali_solat)/18*20)+
                               (SUM(CASE 
                             WHEN amalisolat = "A" THEN 4 
                             WHEN amalisolat = "B" THEN 3                         
                             WHEN amalisolat = "C" THEN 2 
                             WHEN amalisolat = "D" THEN 1                                               
                             ELSE 0 END) +
             
                             (SUM(CASE 
                             WHEN pchi = "A" THEN 4 
                             WHEN pchi = "B" THEN 3                         
                             WHEN pchi = "C" THEN 2 
                             WHEN pchi = "D" THEN 1                                               
                             ELSE 0 END) +
                             
                             SUM(CASE 
                             WHEN baqfield78 = "A" THEN 4 
                             WHEN baqfield78 = "B" THEN 3                         
                             WHEN baqfield78 = "C" THEN 2 
                             WHEN baqfield78 = "D" THEN 1                                               
                             ELSE 0 END) +
             
                             SUM(CASE 
                             WHEN ULUMSYARIAH = "A" THEN 4 
                             WHEN ULUMSYARIAH = "B" THEN 3                         
                             WHEN ULUMSYARIAH = "C" THEN 2 
                             WHEN ULUMSYARIAH = "D" THEN 1                                               
                             ELSE 0 END) +
             
                             SUM(CASE 
                             WHEN JAWIKHAT = "A" THEN 4 
                             WHEN JAWIKHAT = "B" THEN 3                         
                             WHEN JAWIKHAT = "C" THEN 2 
                             WHEN JAWIKHAT = "D" THEN 1                                               
                             ELSE 0 END) +
             
                             SUM(CASE 
                             WHEN SIRAH = "A" THEN 4 
                             WHEN SIRAH = "B" THEN 3                         
                             WHEN SIRAH = "C" THEN 2 
                             WHEN SIRAH = "D" THEN 1                                               
                             ELSE 0 END) +
             
                             SUM(CASE 
                             WHEN ADAB = "A" THEN 4 
                             WHEN ADAB = "B" THEN 3                         
                             WHEN ADAB = "C" THEN 2 
                             WHEN ADAB = "D" THEN 1                                               
                             ELSE 0 END) +
             
                             SUM(CASE 
                             WHEN LUGHATULQURAN = "A" THEN 4 
                             WHEN LUGHATULQURAN = "B" THEN 3                         
                             WHEN LUGHATULQURAN = "C" THEN 2 
                             WHEN LUGHATULQURAN = "D" THEN 1                                               
                             ELSE 0 END))/32*10)+
             
                             (SUM(CASE 
                             WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negara" THEN 5 
                             WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negeri" THEN 4                         
                             WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Daerah/Bahagian/Zon" THEN 3 
                             WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Sekolah" THEN 2 
                             WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Rumah" THEN 1                                             
                             ELSE 0 END) 
                             )   
                             as jumlah,
             
                             (CASE 
                             WHEN KOD_SEKOLAH_P1 IN 
                             ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                             "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                             THEN "M010"
                             WHEN KOD_SEKOLAH_P1 IN 
                             ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                             "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                             THEN "M030"
                             
                             WHEN KOD_SEKOLAH_P1 IN 
                             ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                             "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                             "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                             "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                             "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                             )
                             THEN "M020"
             
                             ELSE "" END) as KOD_PPD_SP1,
             
             
             
                             (CASE 
                             WHEN KOD_SEKOLAH_P2 IN 
                             ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                             "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                             THEN "M010"
                             WHEN KOD_SEKOLAH_P2 IN 
                             ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                             "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                             THEN "M030"
                             
                             WHEN KOD_SEKOLAH_P2 IN 
                             ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                             "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                             "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                             "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                             "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                             )
                             THEN "M020"
             
                             ELSE "" END) as KOD_PPD_SP2,
             
                             (CASE 
                             WHEN KOD_SEKOLAH_P3 IN 
                             ("MEA1060","MEA1061","MEA1072","MEA1076","MEA1077","MEA1078","MEA1079","MEA1080",
                             "MEA1081","MEB1063","MEB1064","MEB1065","MFT1002","MFT1003","MHA1001","MRA1001","MRA1002")
                             THEN "M010"
                             WHEN KOD_SEKOLAH_P3 IN 
                             ( "MEA0071","MEA0072","MEA0073","MEA0074","MEA0075","MEA0095","MEA0099","MEA0100","MEA0101","MEA0102",
                             "MEB0077","MEB0078","MEB0079","MEE0074","MEE0075","MEE0094","MFT0001","MFT0002","MFT0003","MHA0001")
                             THEN "M030"
                             
                             WHEN KOD_SEKOLAH_P3 IN 
                             ("MEA2086",	"MEA2087",	"MEA2088",	"MEA2089",	"MEA2091",	"MEA2092",	"MEA2093",	"MEA2094",
                             "MEA2095",	"MEA2096",	"MEA2097",	"MEA2098",	"MEA2099",	"MEA2100",	"MEA2101",	"MEA2102",	
                             "MEA2103",	"MEB2090",	"MEB2091",	"MEB2092",	"MEB2093",	"MEB2094",	"MEB2095",	"MEB2096",	
                             "MEB2097",	"MEB2098",	"MEB2099",	"MEB2100",	"MEB2101",	"MEB2102",	"MEB2103",	"MEB2104",	
                             "MEB2145",	"MEE2141",	"MFT2001",	"MHA2002",	"MKB2144",	"MRA2125",	"MRA2127"
                             )
                             THEN "M020"
             
                             ELSE "" END) as KOD_PPD_SP3,
             
                              NAMA,NOKP,PENEMPATAN,ALIRAN_PENEMPATAN,
                              NAMA_SEKOLAH_P1,NAMA_SEKOLAH_P2,NAMA_SEKOLAH_P3,
                              PILIHAN_1,PILIHAN_2,PILIHAN_3,NAMA_SEKOLAH_MEN_LULUS,id,KOD_JANTINA,point,PPD_SP1,PPD_SP2,PPD_SP3                    
                             '))
             
             
             ->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
                       'NAMA_SEKOLAH_P1','NAMA_SEKOLAH_P2','NAMA_SEKOLAH_P3',
                       'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
                       'pbd','penguasaan_jawi','pendidikan_islam',
                       'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
                       'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
                       )
             //->limit(50)
             //->get();
                ->paginate(10);     
              // dd($datamurids);
              
        
                     return view('foldatasekolahs.paparcalon', compact('datamurids'));
                 
            
        }
   
}