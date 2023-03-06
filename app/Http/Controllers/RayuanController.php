<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbrayuan;
use Illuminate\Support\Facades\DB;

class RayuanController extends Controller
{
    public function simpan_rayuan(Request $request)
     {
     //  dd($request);
       $NAMA = request('NAMA');        
       $NOKP = request('NOKP');
       $LONG_NAMA_SR1 = request('SR1');
       $LONG_NAMA_SR2 = request('SR2');
       $SEDIA = request('SEDIA');
       
       $NAMA_SR1 = explode(">",$LONG_NAMA_SR1)[2];
       $NAMA_SR2 = explode(">",$LONG_NAMA_SR2)[2];

       $KOD_SR1 = explode(">",$LONG_NAMA_SR1)[1];
       $KOD_SR2 = explode(">",$LONG_NAMA_SR2)[1];

       $ALIRAN_SR1 = explode(">",$LONG_NAMA_SR1)[0];
       $ALIRAN_SR2 = explode(">",$LONG_NAMA_SR2)[0];

      // dd($ALIRAN_SR2);

       $datarayuan = DB::table('tbrayuans')->where('NOKP',$request->NOKP)->first();
       if(!$datarayuan){ 

     //   dd($KOD_SR1);
      
       
                       tbrayuan::create(
                            [
                                 'NAMA' => $NAMA,
                                 'NOKP' => $NOKP,
                                 'NAMA_SR1' => $NAMA_SR1,
                                 'NAMA_SR2' => $NAMA_SR2,
                                 'KOD_SR1'=> $KOD_SR1,
                                 'KOD_SR2'=> $KOD_SR2,
                                 'ALIRAN_SR1'=> $ALIRAN_SR1,
                                 'ALIRAN_SR2'=> $ALIRAN_SR2,
                                 'SEDIA'=>$SEDIA 
                                 
                             ]
                        ); 
                    //   return redirect()->back()->with('message', 'DATA DISIMPAN');
                    //     return view('semakan.hasilrayuan', compact('datarayuan'));
                         return view('semakan.hasilrayuan');
            
            /*     
           DB::insert("INSERT INTO tbrayuans
                    (NAMA,NOKP,NAMA_SR1,NAMA_SR2,KOD_SR1,KOD_SR2,ALIRAN_SR1,ALIRAN_SR2,SEDIA)
                    VALUES
                    ('$NAMA ','$NOKP','$NAMA_SR1','$NAMA_SR2','$KOD_SR1','$KOD_SR2','$ALIRAN_SR1','$ALIRAN_SR2','$SEDIA')"
                     );
            
        
               */
       }
           
      else
         {

          DB::table('tbrayuans')->where('NOKP',$request->NOKP)->update([
               
                'NAMA_SR1' => $NAMA_SR1,
                'NAMA_SR2' => $NAMA_SR2,
                'SEDIA' => request('SEDIA'),
                'KOD_SR1' => $KOD_SR1,
                'KOD_SR2' => $KOD_SR2,
                'ALIRAN_SR1' => $ALIRAN_SR1,
                'ALIRAN_SR2' => $ALIRAN_SR2

            ]);
           // return redirect()->back()->with('message', 'DATA DISIMPAN');
           return view('semakan.hasilrayuan');
        }
       
     }

     public function hasilrayuan()
     {
       //  $hasilrayuan = tbrayuan::where('NOKP',$request->NOKP)->first();
     //    dd($hasilrayuan);

     }

     

}