<html>
    <head>
        <title>Cetakan Surat Tawaran{{$nokp}}</title>
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
            <img src="{{URL::asset('/image/header_sps_baru.jpg')}}" alt="profile Pic" height="100%" width="100%"
                            alignment="center" class="rounded-pill">
        </header>

        <footer>
            <img src="footer.png" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <h1>Hello World</h1>
        </main>
        xx
    </body>
</html>




<head>
    <title>Cetakan Surat Tawaran{{$nokp}}</title>
</head>

<body>
    <img src="{{URL::asset('/image/jata.jpg')}}" alt="profile Pic" height="20%" width="20%" alignment="center" class="rounded-pill" >
    <b>JABATAN PENDIDIKAN NEGERI MELAKA</b>

    <p> <i>Ruj. Kami : JPM.SPS.SM.800.1/1/6 Jld.( 1)</i>
        <br><i>Tarikh: 10 JAN 2022 </i>

        <br><b>Nama Murid: {{$nama}}</b>
        <br><b>No. KP/My Kid :{{$nokp}}</b>



        <p>Saudara/Saudari</p>
        <h4>KEPUTUSAN KEMASUKAN KE TINGKATAN SATU BAGI KELAS ALIRAN AGAMA (KAA), DAN SEKOLAH AGAMA BANTUAN KERAJAAN
            (SABK) NEGERI MELAKA TAHUN 2022 <a></a></h4>
        <p>Merujuk kepada Keputusan Panel Pemilihan Kemasukan Ke Tingkatan Satu <b>KAA/SABK </b>Negeri Melaka Tahun 2022
            bahawa anda ditawarkan ke :-</p>

        <table border="1">
            <tbody>
                <tr>
                    <td>a.Sekolah ditawarkan:</td>
                    <td style="text-align:center;"><b>{{$penempatan}}-{{$aliran}}</b></td>
                </tr>



                <tr>
                    <td>b.Tarikh Lapor Diri/Pengesahan:</td>
                    <td style="text-align:center;"><b>4 JANUARI 2022 HINGGA 20 JANUARI 2022 </b></td>
                </tr>

                <tr>
                    <td>c.Penginapan Asrama:</td>
                    <td style="text-align:center;"><b>TERTAKLUK KEPADA KEKOSONGAN/PERTIMBANGAN PIHAK SEKOLAH (Jika Berkenaan ) </b>
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
        diri/buat pengesahan pada tarikh yang telah ditetapkan. Pelajar yang gagal membuat pengesahan pada tarikh yang
        ditetapkan di atas dianggap sebagai menolak tawaran. Jika anda tidak berminat menerima tawaran tersebut, anda
        boleh meneruskan persekolahan tingkatan 1 di sekolah saluran. <br>

        <br>3.&nbsp;&nbsp;&nbsp;&nbsp;Tawaran ini <b>TERBATAL</b> secara automatik sekiranya pelajar adalah <b>BUKAN
            WARGANEGARA</b>.
        <p>4.&nbsp;&nbsp;&nbsp;&nbsp;Untuk maklumat lanjut sila rujuk Unit Sekolah Menengah dan Tingkatan 6,<b> En Azli
                Bin Musalleh</b> di talian <b>06-2322459</b>.</p>

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
            <b><i style="text-align:left;">*Surat ini adalah cetakan komputer dan tidak memerlukan tandatangan. Tarikh
                    Cetakan: {{$date}}<</i> </b> <p>
                        <i style="text-align:center;">Pendidikan Berkualiti, Insan Terdidik, Negara Sejahtera</i>
                            
</body>

</html>