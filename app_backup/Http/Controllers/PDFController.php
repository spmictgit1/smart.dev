<?php
  
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
  
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

    public function generateSurat($nokp,$nama,$penempatan,$aliran,$notel)
    {
      
   
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadView('surattawaranPDF', ['nokp' => $nokp,
                                        'nama' => $nama,
                                        'penempatan' => $penempatan,
                                        'aliran' =>$aliran,
                                        'notel'=>$notel,
                                        'date' => date('d/m/Y')
    ]);
   //   $pdf = PDF::loadView('surattawaranPDF', $data);
      // dd($nokp);
        return $pdf->download('SuratTawaran.pdf');
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