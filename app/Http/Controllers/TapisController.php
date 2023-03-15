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
class TapisController extends Controller
{
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
            dd($datamurids);
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
}
