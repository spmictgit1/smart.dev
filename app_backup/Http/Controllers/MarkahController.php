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
class MarkahController extends Controller
{
    /* 
    1.PBD 6/6 X 40 %
    2.Pentaksiran Subjek Pendidikan Islam -(Pend. Agama Islam, Jawi & Bahasa Arab)  20%
    3.Amali j-QAF (al-Quran, amali wudhu’ & amali solat) 20 %
    4.UPKK atau setara dengannya (JAKIM) 10%
    5.Pentaksiran Aktiviti Jasmani, Sukan & Kokurikulum (PAJSK) 5%
    6.Pencapaian Khas Islam dan Peringkat. Contoh – Johan Tilawah al-Quran peringkat Kebangsaan 5%
    7.TEMUDUGA KHAS UNTUK CALON KE SM TAHFIZ CHENDERAH JASIN LULUS/GAGAL
    */

    public function markah ()
    { /*
        $pbd = DB::table('datamurids')
        
        ->select(DB::raw('(pbd/6*40) as peratuspbd,                        
                         nama,pbd                        
                        '))
        ->groupBy('nama','pbd')
        ->limit(20)
        ->get();

        $pai = DB::table('datamurids')
        ->select(DB::raw('((penguasaan_jawi + pendidikan_islam +bahasa_arab)/18*20) as pai_jawi_arab,                        
                         nama                        
                        '))
        ->groupBy('nama','penguasaan_jawi','pendidikan_islam','bahasa_arab')
        ->limit(20)
        ->get();

        $jqaf = DB::table('datamurids')
        ->select(DB::raw('((alquran + amali_wuduk +amali_solat)/18*20) as jqaf,                        
                         nama                        
                        '))
        ->groupBy('nama','alquran','amali_wuduk','amali_solat')
        ->limit(20)
        ->get();

        $upkk = DB::table('datamurids')
        ->select(DB::raw('(SUM(CASE 
                        WHEN amalisolat = "A" THEN 4 
                        WHEN amalisolat = "B" THEN 3                         
                        WHEN amalisolat = "C" THEN 2 
                        WHEN amalisolat = "D" THEN 1                                               
                        ELSE 0 END) +

                        SUM(CASE 
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
                        ELSE 0 END))/32*10 as peratus_upkk,

                        nama                        
                        '))
        ->groupBy('nama','amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN')
        ->limit(20)
        ->get();


        $khas_islam = DB::table('datamurids')
        ->select(DB::raw('SUM(CASE 
                        WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negara" THEN 5 
                        WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Negeri" THEN 4                         
                        WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Daerah/Bahagian/Zon" THEN 3 
                        WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Sekolah" THEN 2 
                        WHEN PERINGKAT_KHAS_ISLAM = "Mewakili Rumah" THEN 1                                             
                        ELSE 0 END) as m_khas_islam,
                        
                        PERINGKAT_KHAS_ISLAM,
                        nama                        
        '))
        ->groupBy('nama','PERINGKAT_KHAS_ISLAM')
        ->limit(20)
        ->get();
       */
    //   $jumlah_markah=$pbd+$pai+$jqaf+$upkk+$khas_islam;

    $jumlah_markah = DB::table('datamurids')
        
    ->select(DB::raw('sum(pbd/6*40)+
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
                    ELSE 0 END) + 
                    
                    (pajsk/10*5)
                    )   
                      as jumlah 
                     ,nama                       
                    '))
    ->groupBy('nama','pbd','penguasaan_jawi','pendidikan_islam',
              'bahasa_arab','alquran' , 'amali_wuduk' ,'amali_solat',
              'amalisolat','pchi','baqfield78','ULUMSYARIAH','JAWIKHAT','SIRAH','ADAB','LUGHATULQURAN','PERINGKAT_KHAS_ISLAM','pajsk'
              )
    ->limit(20)
    ->get();
/*
    


*/


        dd($jumlah_markah);
      
         return view();


    }
}