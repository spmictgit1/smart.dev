<?php
  
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use App\Datamurid;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'Surat Tawaran',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->download('SuratTawaran.pdf');
    }

public function generateSurat($nokp,$notel)
    {
        $datasurat=Datamurid::where('NOKP','=',$nokp)->first();
      //  dd($datasurat);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('surattawaranPDF', ['nokp' => $datasurat->NOKP,
                                           'nama' => $datasurat->NAMA,
                                           'penempatan' => $datasurat->PENEMPATAN,
                                           'aliran' =>$datasurat->ALIRAN_PENEMPATAN,
                                           'notel'=>$notel,
                                           'alamat' =>$datasurat->ALAMAT_MURID,
                                           'bandar' => $datasurat->BANDAR,
                                           'poskod' =>$datasurat->POSKOD,
                                           'negeri' => $datasurat->NEGERI,
				 	   'status_rayuan' => $datasurat->STATUS_R,
                                           'date' => date('d/m/Y')
       ]);
      //   $pdf = PDF::loadView('surattawaranPDF', $data);
         // dd($nokp);
           return $pdf->download('SuratTawaran.pdf');






/*
    public function generateSurat($nokp,$nama,$penempatan,$aliran,$notel,
    $ALAMATMURID,$BANDAR,$POSKOD,$NEGERI
    )
    {
      
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadView('surattawaranPDF', ['nokp' => $nokp,
                                        'nama' => $nama,
                                        'penempatan' => $penempatan,
                                        'aliran' =>$aliran,
                                        'notel'=>$notel,
                                        'alamat' =>$ALAMATMURID,
                                        'bandar' => $BANDAR,
                                        'poskod' =>$POSKOD,
                                        'negeri' => $NEGERI,
                                        'date' => date('d/m/Y')
    ]);
   //   $pdf = PDF::loadView('surattawaranPDF', $data);
      // dd($nokp);
        return $pdf->download('SuratTawaran.pdf');
*/
     /*   $data = [
            'title' => 'Surat Tawaran',
            'date' => date('m/d/Y')
        ];*/
          
       
    }
}

/*
 $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('laporanadmin.pdf_la_kelas1',['darjah1' => $darjah1, 'darjah2' => $darjah2,'darjah3' => $darjah3, 'bilpelajar_darjah' => $bilpelajar_darjah]);
            return $pdf->stream(); 
*/