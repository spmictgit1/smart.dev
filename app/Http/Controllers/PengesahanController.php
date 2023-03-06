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
use App\User;

class PengesahanController extends Controller
{
            public function index()
            {
              // if (! Gate::allows('panel')) {
              ///     return abort(401);
              //  }
                
            //    $alldatamurid = Datamurid::all();
            //   $datamurids = Datamurid::paginate(100);      //SINI UBAH PERPAGE BARU 
     //       $datamuridsx = DB::table('datamurids')
       //     ->select('*') 
       //     ->limit(100)
       //     ->get();   
        ///////////////////MARKAH TAMBAHAN////////
        
        if (Auth::user()->kod_organisasi == 'jpnm') {
       $datamurids = DB::table('datamurids')
          
              ->select(DB::raw('
                        NAMA,NOKP,PENEMPATAN,ALIRAN_PENEMPATAN,
                        NAMA_SEKOLAH_P1,NAMA_SEKOLAH_P2,NAMA_SEKOLAH_P3,KAA_NAMA_SEK_DIPOHON,SABK_NAMA_SEK_DIPOHON,
                        PILIHAN_1,PILIHAN_2,PILIHAN_3,NAMA_SEKOLAH_MEN_LULUS,id,sahterima,KOD_JANTINA,NO_TEL_BAPA,NO_TEL_IBU,STATUS_R,
			ALAMAT_MURID,BANDAR,POSKOD,NEGERI,NAMA_SEKOLAH                      
                        '))
              ->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
                        'KRK_NAMA_SEK_DIPOHON','KAA_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON',
                        'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
                        'pbd','penguasaan_jawi','pendidikan_islam',
                        'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
                        'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
                        )
         //     ->where('KOD_PENEMPATAN' ,'=', Auth::user()->kod_organisasi)
                ->where('PENEMPATAN','!=',"")
             // ->limit(20)
             ->orderby('PENEMPATAN','asc')
            //  ->get();
             ->paginate(4000);
             
            // dd($datamurids);
    } 
    
    else 
    {
         $datamurids = DB::table('datamurids')
          
              ->select(DB::raw('
                        NAMA,NOKP,PENEMPATAN,ALIRAN_PENEMPATAN,
                        NAMA_SEKOLAH_P1,NAMA_SEKOLAH_P2,NAMA_SEKOLAH_P3,KAA_NAMA_SEK_DIPOHON,SABK_NAMA_SEK_DIPOHON,
                        PILIHAN_1,PILIHAN_2,PILIHAN_3,NAMA_SEKOLAH_MEN_LULUS,id,sahterima,KOD_JANTINA,NO_TEL_BAPA,NO_TEL_IBU,STATUS_R,
			ALAMAT_MURID,BANDAR,POSKOD,NEGERI,NAMA_SEKOLAH                       
                        '))
              ->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
                        'KRK_NAMA_SEK_DIPOHON','KAA_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON',
                        'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
                        'pbd','penguasaan_jawi','pendidikan_islam',
                        'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
                        'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
                        )
              ->where('KOD_PENEMPATAN' ,'=', Auth::user()->kod_organisasi)
              //  ->where($test ='jpnm')
             // ->limit(20)
             // ->get();
             ->paginate(100);
    }
    return view('pengesahan.index', compact('datamurids'));
        
       
        $datamurids = DB::table('datamurids')
          
              ->select(DB::raw('
                        NAMA,NOKP,PENEMPATAN,ALIRAN_PENEMPATAN,
                        NAMA_SEKOLAH_P1,NAMA_SEKOLAH_P2,NAMA_SEKOLAH_P3,KAA_NAMA_SEK_DIPOHON,SABK_NAMA_SEK_DIPOHON,
                        PILIHAN_1,PILIHAN_2,PILIHAN_3,NAMA_SEKOLAH_MEN_LULUS,id,sahterima,KOD_JANTINA,NO_TEL_BAPA,NO_TEL_IBU,STATUS_R,
			ALAMAT_MURID,BANDAR,POSKOD,NEGERI,NAMA_SEKOLAH                       
                        '))
              ->groupBy('id','NAMA','PENEMPATAN','ALIRAN_PENEMPATAN',
                        'KRK_NAMA_SEK_DIPOHON','KAA_NAMA_SEK_DIPOHON','SABK_NAMA_SEK_DIPOHON',
                        'PILIHAN_1','PILIHAN_2','PILIHAN_3','NAMA_SEKOLAH_MEN_LULUS',
                        'pbd','penguasaan_jawi','pendidikan_islam',
                        'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
                        'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
                        )
         //     ->where('KOD_PENEMPATAN' ,'=', Auth::user()->kod_organisasi)
              //  ->where($test ='jpnm')
             // ->limit(20)
             // ->get();
             ->paginate(100);

                return view('pengesahan.index', compact('datamurids'));
            }



            public function massupdatesah()
               
            {      
                 
                
              
                
                $sahterima = '1';        
              
                  Datamurid::whereIn('id', request('ids'))->update([ 
                  'sahterima' => $sahterima]);

               return redirect()->back()->with('message', 'DATA DISIMPAN');
               
              
            }
           
            public function sahterimadelete(request $request)
            {
            //  dd($request);
        
              $sahterima = '0';        
              // dd($sahterima);
              
                 Datamurid::where('nokp', request('nokp'))->update([ 
                 'sahterima' => $sahterima]);

              //  $permission->delete();
        
                return redirect()->back()->with('message', 'DATA DISIMPAN');
            }



}