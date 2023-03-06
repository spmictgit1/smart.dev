<!DOCTYPE html>
<html>
    <head>
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
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
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
                height: 2cm;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="header.png" width="100%" height="100%"/>
        </header>

        <footer>
            <img src="footer.png" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <h1>Hello World</h1>
        </main>
    </body>
</html>





<html>
<head>
    <title>Cetakan Surat Tawaran</title>
</head>
<body>
    <h3>JABATAN PENDIDIKAN NEGERI MELAKA</h>
    <p>{{ $date }}</p>
    <p><br></br><br></br>
        <br><i style="text-align:right;">Ruj. Kami : JPM.SPS.SM.800.1/1/6 Jld.( 1)</i></br>
        <br><i style="text-align:right;">Tarikh: 4 JAN 2021 </i></br>
        
        
        <br><b>Nama Murid: $name</b></br>
        <br><b>No. KP/My Kid :$nokp</b></br>
        
        
        
        <p>Saudara/Saudari</p>
        <h4>KEPUTUSAN KEMASUKAN KE TINGKATAN SATU BAGI KELAS RANCANGAN KHAS (KRK), KELAS ALIRAN AGAMA (KAA), DAN SEKOLAH AGAMA BANTUAN KERAJAAN (SABK) NEGERI MELAKA TAHUN 2021 <a></a></h4>
        <p>Merujuk kepada Keputusan Panel Pemilihan Kemasukan Ke Tingkatan Satu <b>KRK/KAA/SABK </b>Negeri Melaka Tahun 2021 bahawa anda ditawarkan ke :-</p>
        
        <table border="1">
        <tbody>
        <tr>
        <td>a.Sekolah ditawarkan:</td>
        <td style="text-align:center;"><b>$penempatan-$aliran</b></td>
        </tr>
        
        
        
        <tr>
        <td>b.Tarikh Lapor Diri/Pengesahan:</td>
        <td style="text-align:center;"><b>4 JANUARI 2021 HINGGA 20 JANUARI 2021 </b></td>
        </tr>
        
        <tr>
        <td>c.Penginapan Asrama:</td>
        <td style="text-align:center;"><b>TERTAKLUK KEPADA PERTIMBANGAN PIHAK SEKOLAH (Jika Berkenaan ) </b></td>
        </tr>
        
        <tr>
        <td>d.No Telefon Sekolah:</td>
        <td style="text-align:center;"><b>$notelefon_sekolah</b></td>
        </tr>
        
        </tbody>
        </table><br>
        
        <br>2.&nbsp;&nbsp;&nbsp;&nbsp;Keputusan penempatan ini adalah <b>MUKTAMAD</b>. Jika bersetuju, sila lapor diri/buat pengesahan pada tarikh yang telah ditetapkan. Pelajar yang gagal membuat pengesahan pada tarikh yang ditetapkan di atas dianggap sebagai menolak tawaran. Jika anda tidak berminat menerima tawaran tersebut, anda boleh meneruskan persekolahan tingkatan 1 di sekolah saluran. </br><br></br>
        
        <br>3.&nbsp;&nbsp;&nbsp;&nbsp;Tawaran ini <b>TERBATAL</b> secara automatik sekiranya pelajar adalah <b>BUKAN WARGANEGARA</b>. 
        <p>4.&nbsp;&nbsp;&nbsp;&nbsp;Untuk maklumat lanjut sila rujuk Unit Sekolah Menengah dan Tingkatan 6,<b> En Azli Bin Musalleh</b> di talian <b>06-2322459</b>.</p>
        
        <p>Sekian. terima kasih</p>
        
        <br><b>“MELAKAKU MAJU JAYA, RAKYAT BAHAGIA, MENGGAMIT DUNIA”</b></br>
        <br><b>“BERKHIDMAT UNTUK NEGARA”</b></br>
        <p>Saya yang menjalankan amanah,</p>
        
        
        <br></br><br></br><br></br>
        <br><br><h4>( HAJI  KARIM BIN TUMIN )</h4></br></br>
        <br>Timbalan Pengarah</br>
        <br>Sektor Pengurusan Sekolah</br> 
        <br>b.p : Pengarah Pendidikan Melaka</br>
        
        
        <br></br><br>s.k.</br>
        <br>i. Pengarah Pendidikan Melaka</br>
        <br>ii. Pengetua</br>
        <br>iii. Fail Penyelaras<br>
        
        
        
        
        <br><br><br><br><p><h5><i style="text-align:left;">*Surat ini adalah cetakan komputer dan tidak memerlukan tandatangan. Tarikh Cetakan: {{ $date }}<</i></h5><p></br></br></br></br>
        <p><i style="text-align:center;">Pendidikan Berkualiti, Insan Terdidik, Negara Sejahtera</i><p></p>
</body>
</html>