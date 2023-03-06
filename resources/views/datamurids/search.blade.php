@extends('layouts.admin')

@section('content')
@can('users_manage')
<div style="margin-bottom: 10px;" class="row">

</div>
@endcan


<div class="row">
    <div class="card-body">
        <!--div>
            <p>
                <a class="btn btn-success" href="{{ route('datamurids.index') }}">
                    SENARAI MURID
                    {{-- trans('global.add') }} {{ trans('cruds.user.title_singular') --}}
                </a>

                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-book" aria-hidden="true">
                    </i> PAPAR/TUTUP MODUL PENEMPATAN </button>

            </p>

        </div-->
        <!--div class="card collapse" id="collapseExample"-->
        <div class="card-header bg-primary">
            <h6>MODUL TAPISAN MURID</h6>
        </div>
        <div class="card " id="collapseExample">
            <div class="col-md-12">
                <!-- general form elements -->

                {{--<div>
                    <!--div class="card card-primary"-->

                    <form action="{{ route('cari') }}" method="GET">

                <div>
                    <div class="form-group">
                        <label>No.KP</label>
                        <input type="text" class="form-control" name="nokp" placeholder="Masukkan No.KP">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Calon">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Hantar</button>
                    <button type="reset" class="btn btn-warning">Set Semula</button>
                </div>
                </form>
            </div>
            --}}

            <form action="{{ route('searchfilter') }}" method="GET">
                <div class="row">
                    <div class="col-md-4"> {{--KOLUMN 1--}}<br><br>
                        <div class="card card-primary">
                            <div class="card-header bg-success">
                                <h5 class="card-title">INFO ASAS</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id">
                                </div>
                                <div class="form-group">
                                    <label>No.KP</label>
                                    <input type="text" class="form-control" name="nokp" placeholder="Masukkan No.KP">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukkan Nama Calon">
                                </div>

                                <div class="form-group">
                                    <label for="pilihjantina">Jantina</label>
                                    <select class="custom-select form-control" name="pilihjantina">
                                        <option value="">PILIH JANTINA</option>
                                        <option value="L">LELAKI</option>
                                        <option value="P">PEREMPUAN</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Sekolah Rendah</label>
                                    <select class="custom-select form-control" name="pilih_sek_rendah">
                                        <option value="">TIADA</option>
                                        @foreach ($sekolahrendah as $sk)
                                        <option value="{{$sk->NAMA_SEKOLAH}}">{{$sk->NAMA_SEKOLAH}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="pils1">a.SEKOLAH PILIHAN 1</label>
                                    <select class="custom-select form-control" id="pilkaa" name="pils1">
                                        <option value="">TIADA</option>
                                        @foreach ($skp1 as $dm)
                                        <option value="{{$dm->KOD_SEKOLAH_P1}}">{{$dm->NAMA_SEKOLAH_P1}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pils2">b.SEKOLAH PILIHAN 2</label>
                                    <select class="custom-select form-control" id="pilkaa" name="pils2">
                                        <option value="">TIADA</option>
                                        @foreach ($skp2 as $dm)
                                        <option value="{{$dm->KOD_SEKOLAH_P2}}">{{$dm->NAMA_SEKOLAH_P2}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pils3">b.SEKOLAH PILIHAN 3</label>
                                    <select class="custom-select form-control" id="pilkaa" name="pils3">
                                        <option value="">TIADA</option>
                                        @foreach ($skp3 as $dm)
                                        <option value="{{$dm->KOD_SEKOLAH_P3}}">{{$dm->NAMA_SEKOLAH_P3}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--div class="form-group">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="p1">
                                        <label class="form-check-label">Pilihan 1 sahaja </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="p2">
                                        <label class="form-check-label">Pilihan 2 sahaja </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="p3">
                                        <label class="form-check-label">Pilihan 3 sahaja </label>
                                    </div>

                                </div-->




                                <br><br><br><br>



                            </div>
                        </div>
                    </div> {{--TUTUP KOLUMN 1--}}







                    <div class="col-md-4"> {{--KOLUMN 2--}}<br><br>
                        <div class="card card-primary">
                            <div class="card-header bg-success">
                                <h5 class="card-title">PENILAIAN & PENCAPAIAN</h5>
                            </div>
                            <div class="card-body">
                                {{--MULA SINI--}}

                                <div class="form-group">
                                    <label for="tp_bahasa_arab">TP BAHASA ARAB JQAF</label>
                                    <select class="custom-select form-control" name="tp_bahasa_arab">
                                        <option value="">SEMUA</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>

                                <!--div class="form-group">
                                    <label>JULAT B.ARAB JQAF</label>
                                    <input type="text" class="form-control" name="jqafmin" placeholder="DARIPADA">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="jqafmax" placeholder="SEHINGGA">
                                </div-->

                                <div class="form-group">
                                    <label>TAHAP SUKAN</label>
                                    <select class="custom-select form-control" name="pilih_tahap_sukan">
                                        <option value="">SEMUA</option>
                                        <option value="Tiada">TIADA</option>
                                        <option value="Antarabangsa">ANTARABANGSA</option>
                                        <option value="Kebangsaan">KEBANGSAAN</option>
                                        <option value="Negeri">NEGERI</option>
                                        <option value="Bahagian (Sabah/Sarawak)">BAHAGIAN (SABAH/SARAWAK)</option>
                                        <option value="Zon/Daerah">MEWAKILI DAERAH/ BAHAGIAN/ ZON
                                        </option>
                                        <option value="Sekolah">SEKOLAH</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="khas_islam">PERINGKAT KHAS P.ISLAM</label>
                                    <select class="custom-select form-control" name="khas_islam">
                                        <option value="">SEMUA</option>
                                        <option value="Mewakili Negara">WAKIL NEGARA</option>
                                        <option value="Mewakili Negeri">WAKIL NEGERI</option>
                                        <option value="Mewakili Daerah/Bahagian/Zon">WAKIL DAERAH/BAHAGIAN/ZON</option>
                                        <option value="Mewakili Rumah">WAKIL RUMAH</option>
                                        <option value="Mewakili Sekolah">WAKIL SEKOLAH</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>MERIT</label>
                                    <input type="text" class="form-control" name="meritmin" placeholder="DARIPADA">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="meritmax" placeholder="SEHINGGA">
                                </div>
                                
                                <div class="form-group">
                                    <label for="sekpenempatan">SEKOLAH PENEMPATAN</label>
                                    <select class="custom-select form-control" id="sekpenempatan" name="sekpenempatan">
                                        <option value="">TIADA</option>
                                        @foreach ($sekpenempatan as $dm)
                                        <option value="{{$dm->KOD_PENEMPATAN}}">{{$dm->PENEMPATAN}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                {{--    <div class="form-group">
                                    <label>Sekolah Rendah</label>
                                    <select class="custom-select form-control" name="pilih_sek_rendah">
                                        <option value="">TIADA</option>
                                        @foreach ($sekolahrendah as $sk)
                                        <option value="{{$sk->NAMA_SEKOLAH}}">{{$sk->NAMA_SEKOLAH}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                --}}
                                
                               
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sudah_penempatan">
                                    <label class="form-check-label">Telah Ditempatkan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="belum_penempatan">
                                    <label class="form-check-label">Belum Ditempatkan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pemohon_rayuan">
                                    <label class="form-check-label">Pemohon Rayuan</label>
                                </div>
                                {{--TAMAT SINI--}}
                            </div>
                        </div>
                    </div>{{--TUTUP KOLUMN 2--}}


                    <!--div class="col-md-4"> {{--KOLUMN 3--}}
                        <div class="card card-primary">
                            <div class="card-header bg-success">
                                <h5 class="card-title">PAPARAN</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> {{--KIRI--}}
                                    <div class="card-body">
                                        <div class="form-group">

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Markah (%)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Maklumat Asas</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">UPSR</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">UPKK</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">SIA</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Amali</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Bahasa Arab</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> {{--KANAN--}}
                                    <div class="card-body">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Koku</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Jawatan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Khas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Jenis Data</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Sekolah Pilihan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Pemilih</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Catatan</label>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header bg-success">
                                <h5 class="card-title">TETAPAN</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12"> {{--KIRI--}}
                                    <div class="card-body">
                                        <div class="form-group">

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Pemohon
                                                    APDM/Tambahan</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Pemohon
                                                    Lewat/Luar/Swasta</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Pemohon SABK
                                                    Rendah</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Ada Catatan</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Ada Markah
                                                    Tahfiz</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div-->



                    <!--div class="card card-primary">
                            <div class="card-header bg-success">
                                <h5 class="card-title">SUSUNAN IKUT</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12"> {{--KIRI--}}
                                    <div class="card-body">
                                        <div class="form-group">


                                            <label for="exampleSelectBorder"></label>
                                            <select class="custom-select form-control" id="exampleSelectBorder">
                                                <option>MARKAH</option>
                                                <option>UPSR</option>
                                                <option>MARKAH TAHFIZ</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div--> {{--TUTUP KOLUMN 3--}}

                   
                </div>


                <!-- /.card -->
        </div>

    </div>
    <div>
        <button type="submit" class="btn btn-success">Teruskan</button>
        <button type="reset" class="btn btn-warning">Set Semula</button>
    </div>

</div>



</form>


</div>
@endsection