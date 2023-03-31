<html>

<head>
    <title>Cetakan Surat Tawaran: {{$nokp}}/{{$nama}}</title>
    <style>
        /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 0.5cm;
            margin-right: 0.5cm;
            margin-bottom: 0.5cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
        }
   /**     #watermark {
                position: fixed;
                bottom:   0px;
                left:     0px;
                /** The width and height may change 
                    according to the dimensions of your letterhead
                **/
                width:    21.8cm;
                height:   28cm;  

                

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            } 
            **/
      
    </style>
</head>

<body>

    <div id="watermark">
        <img src="{{URL::asset('/image/xjata.jpg')}}" alt="profile Pic" height="90%" width="100%"
            alignment="center" class="rounded-pill">
    </div>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="{{URL::asset('/image/header_sps_baru.jpg')}}" alt="profile Pic" height="90%" width="100%"
            alignment="center" class="rounded-pill"/>
    </header>

    <footer>
        <i style="display: block; margin-left: auto; margin-right: auto; font-size: 16px; text-align: center;">Pendidikan Berkualiti, Insan Terdidik, Negara Sejahtera</i>
            <!--img src="footer.png" width="100%" height="100%"/-->
        </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <!--main>
        </main-->
        <i style="display: block; margin-left: auto; margin-right: auto; font-size: 16px; text-align: right;">
        <i>Ruj. Kami : JPM.SPS.SM.800.1/1/6 Jld.(2{{$status_rayuan}})</i><br>
        <i>Tarikh: 6 MAC 2023 </i>
        </i>  
    
    <b>{{$nama}} {{$nokp}}</b>
    <br><b>{{$alamat}} {{$bandar}} {{$poskod}} {{$negeri}}</b>
    
   



    <p>Saudara/Saudari</p>
    <h4>KEPUTUSAN KEMASUKAN KE TINGKATAN SATU BAGI KELAS ALIRAN AGAMA (KAA), DAN SEKOLAH AGAMA BANTUAN KERAJAAN
        (SABK) NEGERI MELAKA TAHUN 2023 <a></a></h4>
    <p>Merujuk kepada Keputusan Panel Pemilihan Kemasukan Ke Tingkatan Satu <b>KAA/SABK </b>Negeri Melaka Tahun 2023
        bahawa anda ditawarkan ke :-</p>

    <table border="1">
        <tbody>
            <tr>
                <td>a.Sekolah ditawarkan:</td>
                <td style="text-align:center;"><b>{{$penempatan}}-{{$aliran}}</b></td>
            </tr>



            <tr>
                <td>b.Tarikh Lapor Diri/Pengesahan:</td>
                <td style="text-align:center;"><b>FASA 1: 6 MAC 2023 HINGGA 15 MAC 2023 </b><br><b>RAYUAN: 3 APRIL 2023 HINGGA 7 APRIL 2023 </b></td>
            </tr>

            <tr>
                <td>c.Penginapan Asrama:</td>
                <td style="text-align:center;"><b>TERTAKLUK KEPADA KEKOSONGAN/PERTIMBANGAN PIHAK SEKOLAH (Jika Berkenaan
                        ) </b>
                </td>
            </tr>

            <tr>
                <td>d.No Telefon Sekolah:</td>
                <td style="text-align:center;">
                    <b>0{{$notel}}
                    </b></td>
            </tr>

        </tbody>
    </table>

    <br>2.&nbsp;&nbsp;&nbsp;&nbsp;Keputusan penempatan ini adalah <b>MUKTAMAD</b>. Jika bersetuju, sila lapor
    diri/buat pengesahan pada tarikh yang telah ditetapkan. <b>Pelajar yang gagal</b> membuat pengesahan pada tarikh yang
    ditetapkan di atas dianggap sebagai <b>menolak tawaran</b>. Jika anda tidak berminat menerima tawaran tersebut, anda
    boleh meneruskan persekolahan tingkatan 1 di sekolah saluran. <br>

    <br>3.&nbsp;&nbsp;&nbsp;&nbsp;Tawaran ini <b>TERBATAL</b> secara automatik sekiranya pelajar adalah <b>BUKAN
        WARGANEGARA</b>.
    <p>4.&nbsp;&nbsp;&nbsp;&nbsp;Untuk maklumat lanjut sila rujuk Penolong Pengarah Unit Perancangan dan Pembangunan Pendidikan Islam,<b>Ustaz Norhisham Bin Miswan</b> di talian <b> 06-2326732 </b></p>

    <p>Sekian. terima kasih</p>

    <b>“MELAKAKU MAJU JAYA, RAKYAT BAHAGIA, MENGGAMIT DUNIA”</b><br>
    <b>“BERKHIDMAT UNTUK NEGARA”</b>
    <p>Saya yang menjalankan amanah,</p>

    <b>( HAJI KARIM BIN TUMIN )</b>
    <br>Timbalan Pengarah
    <br>Sektor Pengurusan Sekolah
    <br>b.p : Pengarah Pendidikan Melaka

    <br>s.k.
    <br>i. Pengarah Pendidikan Melaka
    <br>ii. Pengetua
    <br>iii. Fail Penyelaras
    <p>
        <b><i style="display: block; margin-left: auto; margin-right: auto; font-size: 16px; text-align: center;">*Surat ini adalah cetakan komputer dan tidak memerlukan tandatangan. Tarikh
                Cetakan: {{$date}}<</i> </b> <p>
                    
</body>

</html>
