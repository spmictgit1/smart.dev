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
        <div class="card-header bg-warning">
            <h5>MODUL PEMILIHAN MURID</h5>
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
                                    <label for="exampleSelectBorder">UPKK</label>
                                    <select class="custom-select form-control" id="exampleSelectBorder">
                                        <option value="UPKK_TIADA">TIADA</option>
                                        <option value="UPKK_8A">8A</option>
                                        <option value="UPKK_7A1B">7A1B</option>
                                        <option value="UPKK_7A1C">7A1C</option>
                                        <option value="UPKK_7A1D">7A1D</option>
                                        <option value="UPKK_7A1TH">7A1TH</option>
                                        <option value="UPKK_6A2B">6A2B</option>
                                        <option value="UPKK_6A1B1C">6A1B1C</option>
                                        <option value="UPKK_6A1B1D">6A1B1D</option>
                                        <option value="UPKK_6A1B1TH">6A1B1TH</option>
                                        <option value="UPKK_6A2C">6A2C</option>
                                        <option value="UPKK_6A1C1D">6A1C1D</option>
                                        <option value="UPKK_6A1C1TH">6A1C1TH</option>
                                        <option value="UPKK_6A2D">6A2D</option>
                                        <option value="UPKK_6A1D1TH">6A1D1TH</option>
                                        <option value="UPKK_6A2TH">6A2TH</option>
                                        <option value="UPKK_5A3B">5A3B</option>
                                        <option value="UPKK_5A2B1C">5A2B1C</option>
                                        <option value="UPKK_5A2B1D">5A2B1D</option>
                                        <option value="UPKK_5A2B1TH">5A2B1TH</option>
                                        <option value="UPKK_5A1B2C">5A1B2C</option>
                                        <option value="UPKK_5A1B1C1D">5A1B1C1D</option>
                                        <option value="UPKK_5A1B1C1TH">5A1B1C1TH</option>
                                        <option value="UPKK_5A1B2D">5A1B2D</option>
                                        <option value="UPKK_5A1B1D1TH">5A1B1D1TH</option>
                                        <option value="UPKK_5A1B2TH">5A1B2TH</option>
                                        <option value="UPKK_5A3C">5A3C</option>
                                        <option value="UPKK_5A2C1D">5A2C1D</option>
                                        <option value="UPKK_5A2C1TH">5A2C1TH</option>
                                        <option value="UPKK_5A1C2D">5A1C2D</option>
                                        <option value="UPKK_5A1C1D1TH">5A1C1D1TH</option>
                                        <option value="UPKK_5A1C2TH">5A1C2TH</option>
                                        <option value="UPKK_5A3D">5A3D</option>
                                        <option value="UPKK_5A2D1TH">5A2D1TH</option>
                                        <option value="UPKK_5A1D2TH">5A1D2TH</option>
                                        <option value="UPKK_5A3TH">5A3TH</option>
                                        <option value="UPKK_4A4B">4A4B</option>
                                        <option value="UPKK_4A3B1C">4A3B1C</option>
                                        <option value="UPKK_4A3B1D">4A3B1D</option>
                                        <option value="UPKK_4A3B1TH">4A3B1TH</option>
                                        <option value="UPKK_4A2B2C">4A2B2C</option>
                                        <option value="UPKK_4A2B1C1D">4A2B1C1D</option>
                                        <option value="UPKK_4A2B1C1TH">4A2B1C1TH</option>
                                        <option value="UPKK_4A2B2D">4A2B2D</option>
                                        <option value="UPKK_4A2B1D1TH">4A2B1D1TH</option>
                                        <option value="UPKK_4A2B2TH">4A2B2TH</option>
                                        <option value="UPKK_4A1B3C">4A1B3C</option>
                                        <option value="UPKK_4A1B2C1D">4A1B2C1D</option>
                                        <option value="UPKK_4A1B2C1TH">4A1B2C1TH</option>
                                        <option value="UPKK_4A1B1C2D">4A1B1C2D</option>
                                        <option value="UPKK_4A1B1C1D1TH">4A1B1C1D1TH</option>
                                        <option value="UPKK_4A1B1C2TH">4A1B1C2TH</option>
                                        <option value="UPKK_4A1B3D">4A1B3D</option>
                                        <option value="UPKK_4A1B2D1TH">4A1B2D1TH</option>
                                        <option value="UPKK_4A1B1D2TH">4A1B1D2TH</option>
                                        <option value="UPKK_4A1B3TH">4A1B3TH</option>
                                        <option value="UPKK_4A4C">4A4C</option>
                                        <option value="UPKK_4A3C1D">4A3C1D</option>
                                        <option value="UPKK_4A3C1TH">4A3C1TH</option>
                                        <option value="UPKK_4A2C2D">4A2C2D</option>
                                        <option value="UPKK_4A2C1D1TH">4A2C1D1TH</option>
                                        <option value="UPKK_4A2C2TH">4A2C2TH</option>
                                        <option value="UPKK_4A1C3D">4A1C3D</option>
                                        <option value="UPKK_4A1C2D1TH">4A1C2D1TH</option>
                                        <option value="UPKK_4A1C1D2TH">4A1C1D2TH</option>
                                        <option value="UPKK_4A1C3TH">4A1C3TH</option>
                                        <option value="UPKK_4A4D">4A4D</option>
                                        <option value="UPKK_4A3D1TH">4A3D1TH</option>
                                        <option value="UPKK_4A2D2TH">4A2D2TH</option>
                                        <option value="UPKK_4A1D3TH">4A1D3TH</option>
                                        <option value="UPKK_4A4TH">4A4TH</option>
                                        <option value="UPKK_3A5B">3A5B</option>
                                        <option value="UPKK_3A4B1C">3A4B1C</option>
                                        <option value="UPKK_3A4B1D">3A4B1D</option>
                                        <option value="UPKK_3A4B1TH">3A4B1TH</option>
                                        <option value="UPKK_3A3B2C">3A3B2C</option>
                                        <option value="UPKK_3A3B1C1D">3A3B1C1D</option>
                                        <option value="UPKK_3A3B1C1TH">3A3B1C1TH</option>
                                        <option value="UPKK_3A3B2D">3A3B2D</option>
                                        <option value="UPKK_3A3B1D1TH">3A3B1D1TH</option>
                                        <option value="UPKK_3A3B2TH">3A3B2TH</option>
                                        <option value="UPKK_3A2B3C">3A2B3C</option>
                                        <option value="UPKK_3A2B2C1D">3A2B2C1D</option>
                                        <option value="UPKK_3A2B2C1TH">3A2B2C1TH</option>
                                        <option value="UPKK_3A2B1C2D">3A2B1C2D</option>
                                        <option value="UPKK_3A2B1C1D1TH">3A2B1C1D1TH</option>
                                        <option value="UPKK_3A2B1C2TH">3A2B1C2TH</option>
                                        <option value="UPKK_3A2B3D">3A2B3D</option>
                                        <option value="UPKK_3A2B2D1TH">3A2B2D1TH</option>
                                        <option value="UPKK_3A2B1D2TH">3A2B1D2TH</option>
                                        <option value="UPKK_3A2B3TH">3A2B3TH</option>
                                        <option value="UPKK_3A1B4C">3A1B4C</option>
                                        <option value="UPKK_3A1B3C1D">3A1B3C1D</option>
                                        <option value="UPKK_3A1B3C1TH">3A1B3C1TH</option>
                                        <option value="UPKK_3A1B2C2D">3A1B2C2D</option>
                                        <option value="UPKK_3A1B2C1D1TH">3A1B2C1D1TH</option>
                                        <option value="UPKK_3A1B2C2TH">3A1B2C2TH</option>
                                        <option value="UPKK_3A1B1C3D">3A1B1C3D</option>
                                        <option value="UPKK_3A1B1C2D1TH">3A1B1C2D1TH</option>
                                        <option value="UPKK_3A1B1C1D2TH">3A1B1C1D2TH</option>
                                        <option value="UPKK_3A1B1C3TH">3A1B1C3TH</option>
                                        <option value="UPKK_3A1B4D">3A1B4D</option>
                                        <option value="UPKK_3A1B3D1TH">3A1B3D1TH</option>
                                        <option value="UPKK_3A1B2D2TH">3A1B2D2TH</option>
                                        <option value="UPKK_3A1B1D3TH">3A1B1D3TH</option>
                                        <option value="UPKK_3A1B4TH">3A1B4TH</option>
                                        <option value="UPKK_3A5C">3A5C</option>
                                        <option value="UPKK_3A4C1D">3A4C1D</option>
                                        <option value="UPKK_3A4C1TH">3A4C1TH</option>
                                        <option value="UPKK_3A3C2D">3A3C2D</option>
                                        <option value="UPKK_3A3C1D1TH">3A3C1D1TH</option>
                                        <option value="UPKK_3A3C2TH">3A3C2TH</option>
                                        <option value="UPKK_3A2C3D">3A2C3D</option>
                                        <option value="UPKK_3A2C2D1TH">3A2C2D1TH</option>
                                        <option value="UPKK_3A2C1D2TH">3A2C1D2TH</option>
                                        <option value="UPKK_3A2C3TH">3A2C3TH</option>
                                        <option value="UPKK_3A1C4D">3A1C4D</option>
                                        <option value="UPKK_3A1C3D1TH">3A1C3D1TH</option>
                                        <option value="UPKK_3A1C2D2TH">3A1C2D2TH</option>
                                        <option value="UPKK_3A1C1D3TH">3A1C1D3TH</option>
                                        <option value="UPKK_3A1C4TH">3A1C4TH</option>
                                        <option value="UPKK_3A5D">3A5D</option>
                                        <option value="UPKK_3A4D1TH">3A4D1TH</option>
                                        <option value="UPKK_3A3D2TH">3A3D2TH</option>
                                        <option value="UPKK_3A2D3TH">3A2D3TH</option>
                                        <option value="UPKK_3A1D4TH">3A1D4TH</option>
                                        <option value="UPKK_3A5TH">3A5TH</option>
                                        <option value="UPKK_2A6B">2A6B</option>
                                        <option value="UPKK_2A5B1C">2A5B1C</option>
                                        <option value="UPKK_2A5B1D">2A5B1D</option>
                                        <option value="UPKK_2A5B1TH">2A5B1TH</option>
                                        <option value="UPKK_2A4B2C">2A4B2C</option>
                                        <option value="UPKK_2A4B1C1D">2A4B1C1D</option>
                                        <option value="UPKK_2A4B1C1TH">2A4B1C1TH</option>
                                        <option value="UPKK_2A4B2D">2A4B2D</option>
                                        <option value="UPKK_2A4B1D1TH">2A4B1D1TH</option>
                                        <option value="UPKK_2A4B2TH">2A4B2TH</option>
                                        <option value="UPKK_2A3B3C">2A3B3C</option>
                                        <option value="UPKK_2A3B2C1D">2A3B2C1D</option>
                                        <option value="UPKK_2A3B2C1TH">2A3B2C1TH</option>
                                        <option value="UPKK_2A3B1C2D">2A3B1C2D</option>
                                        <option value="UPKK_2A3B1C1D1TH">2A3B1C1D1TH</option>
                                        <option value="UPKK_2A3B1C2TH">2A3B1C2TH</option>
                                        <option value="UPKK_2A3B3D">2A3B3D</option>
                                        <option value="UPKK_2A3B2D1TH">2A3B2D1TH</option>
                                        <option value="UPKK_2A3B1D2TH">2A3B1D2TH</option>
                                        <option value="UPKK_2A3B3TH">2A3B3TH</option>
                                        <option value="UPKK_2A2B4C">2A2B4C</option>
                                        <option value="UPKK_2A2B3C1D">2A2B3C1D</option>
                                        <option value="UPKK_2A2B3C1TH">2A2B3C1TH</option>
                                        <option value="UPKK_2A2B2C2D">2A2B2C2D</option>
                                        <option value="UPKK_2A2B2C1D1TH">2A2B2C1D1TH</option>
                                        <option value="UPKK_2A2B2C2TH">2A2B2C2TH</option>
                                        <option value="UPKK_2A2B1C3D">2A2B1C3D</option>
                                        <option value="UPKK_2A2B1C2D1TH">2A2B1C2D1TH</option>
                                        <option value="UPKK_2A2B1C1D2TH">2A2B1C1D2TH</option>
                                        <option value="UPKK_2A2B1C3TH">2A2B1C3TH</option>
                                        <option value="UPKK_2A2B4D">2A2B4D</option>
                                        <option value="UPKK_2A2B3D1TH">2A2B3D1TH</option>
                                        <option value="UPKK_2A2B2D2TH">2A2B2D2TH</option>
                                        <option value="UPKK_2A2B1D3TH">2A2B1D3TH</option>
                                        <option value="UPKK_2A2B4TH">2A2B4TH</option>
                                        <option value="UPKK_2A1B5C">2A1B5C</option>
                                        <option value="UPKK_2A1B4C1D">2A1B4C1D</option>
                                        <option value="UPKK_2A1B4C1TH">2A1B4C1TH</option>
                                        <option value="UPKK_2A1B3C2D">2A1B3C2D</option>
                                        <option value="UPKK_2A1B3C1D1TH">2A1B3C1D1TH</option>
                                        <option value="UPKK_2A1B3C2TH">2A1B3C2TH</option>
                                        <option value="UPKK_2A1B2C3D">2A1B2C3D</option>
                                        <option value="UPKK_2A1B2C2D1TH">2A1B2C2D1TH</option>
                                        <option value="UPKK_2A1B2C1D2TH">2A1B2C1D2TH</option>
                                        <option value="UPKK_2A1B2C3TH">2A1B2C3TH</option>
                                        <option value="UPKK_2A1B1C4D">2A1B1C4D</option>
                                        <option value="UPKK_2A1B1C3D1TH">2A1B1C3D1TH</option>
                                        <option value="UPKK_2A1B1C2D2TH">2A1B1C2D2TH</option>
                                        <option value="UPKK_2A1B1C1D3TH">2A1B1C1D3TH</option>
                                        <option value="UPKK_2A1B1C4TH">2A1B1C4TH</option>
                                        <option value="UPKK_2A1B5D">2A1B5D</option>
                                        <option value="UPKK_2A1B4D1TH">2A1B4D1TH</option>
                                        <option value="UPKK_2A1B3D2TH">2A1B3D2TH</option>
                                        <option value="UPKK_2A1B2D3TH">2A1B2D3TH</option>
                                        <option value="UPKK_2A1B1D4TH">2A1B1D4TH</option>
                                        <option value="UPKK_2A1B5TH">2A1B5TH</option>
                                        <option value="UPKK_2A6C">2A6C</option>
                                        <option value="UPKK_2A5C1D">2A5C1D</option>
                                        <option value="UPKK_2A5C1TH">2A5C1TH</option>
                                        <option value="UPKK_2A4C2D">2A4C2D</option>
                                        <option value="UPKK_2A4C1D1TH">2A4C1D1TH</option>
                                        <option value="UPKK_2A4C2TH">2A4C2TH</option>
                                        <option value="UPKK_2A3C3D">2A3C3D</option>
                                        <option value="UPKK_2A3C2D1TH">2A3C2D1TH</option>
                                        <option value="UPKK_2A3C1D2TH">2A3C1D2TH</option>
                                        <option value="UPKK_2A3C3TH">2A3C3TH</option>
                                        <option value="UPKK_2A2C4D">2A2C4D</option>
                                        <option value="UPKK_2A2C3D1TH">2A2C3D1TH</option>
                                        <option value="UPKK_2A2C2D2TH">2A2C2D2TH</option>
                                        <option value="UPKK_2A2C1D3TH">2A2C1D3TH</option>
                                        <option value="UPKK_2A2C4TH">2A2C4TH</option>
                                        <option value="UPKK_2A1C5D">2A1C5D</option>
                                        <option value="UPKK_2A1C4D1TH">2A1C4D1TH</option>
                                        <option value="UPKK_2A1C3D2TH">2A1C3D2TH</option>
                                        <option value="UPKK_2A1C2D3TH">2A1C2D3TH</option>
                                        <option value="UPKK_2A1C1D4TH">2A1C1D4TH</option>
                                        <option value="UPKK_2A1C5TH">2A1C5TH</option>
                                        <option value="UPKK_2A6D">2A6D</option>
                                        <option value="UPKK_2A5D1TH">2A5D1TH</option>
                                        <option value="UPKK_2A4D2TH">2A4D2TH</option>
                                        <option value="UPKK_2A3D3TH">2A3D3TH</option>
                                        <option value="UPKK_2A2D4TH">2A2D4TH</option>
                                        <option value="UPKK_2A1D5TH">2A1D5TH</option>
                                        <option value="UPKK_2A6TH">2A6TH</option>
                                        <option value="UPKK_1A7B">1A7B</option>
                                        <option value="UPKK_1A6B1C">1A6B1C</option>
                                        <option value="UPKK_1A6B1D">1A6B1D</option>
                                        <option value="UPKK_1A6B1TH">1A6B1TH</option>
                                        <option value="UPKK_1A5B2C">1A5B2C</option>
                                        <option value="UPKK_1A5B1C1D">1A5B1C1D</option>
                                        <option value="UPKK_1A5B1C1TH">1A5B1C1TH</option>
                                        <option value="UPKK_1A5B2D">1A5B2D</option>
                                        <option value="UPKK_1A5B1D1TH">1A5B1D1TH</option>
                                        <option value="UPKK_1A5B2TH">1A5B2TH</option>
                                        <option value="UPKK_1A4B3C">1A4B3C</option>
                                        <option value="UPKK_1A4B2C1D">1A4B2C1D</option>
                                        <option value="UPKK_1A4B2C1TH">1A4B2C1TH</option>
                                        <option value="UPKK_1A4B1C2D">1A4B1C2D</option>
                                        <option value="UPKK_1A4B1C1D1TH">1A4B1C1D1TH</option>
                                        <option value="UPKK_1A4B1C2TH">1A4B1C2TH</option>
                                        <option value="UPKK_1A4B3D">1A4B3D</option>
                                        <option value="UPKK_1A4B2D1TH">1A4B2D1TH</option>
                                        <option value="UPKK_1A4B1D2TH">1A4B1D2TH</option>
                                        <option value="UPKK_1A4B3TH">1A4B3TH</option>
                                        <option value="UPKK_1A3B4C">1A3B4C</option>
                                        <option value="UPKK_1A3B3C1D">1A3B3C1D</option>
                                        <option value="UPKK_1A3B3C1TH">1A3B3C1TH</option>
                                        <option value="UPKK_1A3B2C2D">1A3B2C2D</option>
                                        <option value="UPKK_1A3B2C1D1TH">1A3B2C1D1TH</option>
                                        <option value="UPKK_1A3B2C2TH">1A3B2C2TH</option>
                                        <option value="UPKK_1A3B1C3D">1A3B1C3D</option>
                                        <option value="UPKK_1A3B1C2D1TH">1A3B1C2D1TH</option>
                                        <option value="UPKK_1A3B1C1D2TH">1A3B1C1D2TH</option>
                                        <option value="UPKK_1A3B1C3TH">1A3B1C3TH</option>
                                        <option value="UPKK_1A3B4D">1A3B4D</option>
                                        <option value="UPKK_1A3B3D1TH">1A3B3D1TH</option>
                                        <option value="UPKK_1A3B2D2TH">1A3B2D2TH</option>
                                        <option value="UPKK_1A3B1D3TH">1A3B1D3TH</option>
                                        <option value="UPKK_1A3B4TH">1A3B4TH</option>
                                        <option value="UPKK_1A2B5C">1A2B5C</option>
                                        <option value="UPKK_1A2B4C1D">1A2B4C1D</option>
                                        <option value="UPKK_1A2B4C1TH">1A2B4C1TH</option>
                                        <option value="UPKK_1A2B3C2D">1A2B3C2D</option>
                                        <option value="UPKK_1A2B3C1D1TH">1A2B3C1D1TH</option>
                                        <option value="UPKK_1A2B3C2TH">1A2B3C2TH</option>
                                        <option value="UPKK_1A2B2C3D">1A2B2C3D</option>
                                        <option value="UPKK_1A2B2C2D1TH">1A2B2C2D1TH</option>
                                        <option value="UPKK_1A2B2C1D2TH">1A2B2C1D2TH</option>
                                        <option value="UPKK_1A2B2C3TH">1A2B2C3TH</option>
                                        <option value="UPKK_1A2B1C4D">1A2B1C4D</option>
                                        <option value="UPKK_1A2B1C3D1TH">1A2B1C3D1TH</option>
                                        <option value="UPKK_1A2B1C2D2TH">1A2B1C2D2TH</option>
                                        <option value="UPKK_1A2B1C1D3TH">1A2B1C1D3TH</option>
                                        <option value="UPKK_1A2B1C4TH">1A2B1C4TH</option>
                                        <option value="UPKK_1A2B5D">1A2B5D</option>
                                        <option value="UPKK_1A2B4D1TH">1A2B4D1TH</option>
                                        <option value="UPKK_1A2B3D2TH">1A2B3D2TH</option>
                                        <option value="UPKK_1A2B2D3TH">1A2B2D3TH</option>
                                        <option value="UPKK_1A2B1D4TH">1A2B1D4TH</option>
                                        <option value="UPKK_1A2B5TH">1A2B5TH</option>
                                        <option value="UPKK_1A1B6C">1A1B6C</option>
                                        <option value="UPKK_1A1B5C1D">1A1B5C1D</option>
                                        <option value="UPKK_1A1B5C1TH">1A1B5C1TH</option>
                                        <option value="UPKK_1A1B4C2D">1A1B4C2D</option>
                                        <option value="UPKK_1A1B4C1D1TH">1A1B4C1D1TH</option>
                                        <option value="UPKK_1A1B4C2TH">1A1B4C2TH</option>
                                        <option value="UPKK_1A1B3C3D">1A1B3C3D</option>
                                        <option value="UPKK_1A1B3C2D1TH">1A1B3C2D1TH</option>
                                        <option value="UPKK_1A1B3C1D2TH">1A1B3C1D2TH</option>
                                        <option value="UPKK_1A1B3C3TH">1A1B3C3TH</option>
                                        <option value="UPKK_1A1B2C4D">1A1B2C4D</option>
                                        <option value="UPKK_1A1B2C3D1TH">1A1B2C3D1TH</option>
                                        <option value="UPKK_1A1B2C2D2TH">1A1B2C2D2TH</option>
                                        <option value="UPKK_1A1B2C1D3TH">1A1B2C1D3TH</option>
                                        <option value="UPKK_1A1B2C4TH">1A1B2C4TH</option>
                                        <option value="UPKK_1A1B1C5D">1A1B1C5D</option>
                                        <option value="UPKK_1A1B1C4D1TH">1A1B1C4D1TH</option>
                                        <option value="UPKK_1A1B1C3D2TH">1A1B1C3D2TH</option>
                                        <option value="UPKK_1A1B1C2D3TH">1A1B1C2D3TH</option>
                                        <option value="UPKK_1A1B1C1D4TH">1A1B1C1D4TH</option>
                                        <option value="UPKK_1A1B1C5TH">1A1B1C5TH</option>
                                        <option value="UPKK_1A1B6D">1A1B6D</option>
                                        <option value="UPKK_1A1B5D1TH">1A1B5D1TH</option>
                                        <option value="UPKK_1A1B4D2TH">1A1B4D2TH</option>
                                        <option value="UPKK_1A1B3D3TH">1A1B3D3TH</option>
                                        <option value="UPKK_1A1B2D4TH">1A1B2D4TH</option>
                                        <option value="UPKK_1A1B1D5TH">1A1B1D5TH</option>
                                        <option value="UPKK_1A1B6TH">1A1B6TH</option>
                                        <option value="UPKK_1A7C">1A7C</option>
                                        <option value="UPKK_1A6C1D">1A6C1D</option>
                                        <option value="UPKK_1A6C1TH">1A6C1TH</option>
                                        <option value="UPKK_1A5C2D">1A5C2D</option>
                                        <option value="UPKK_1A5C1D1TH">1A5C1D1TH</option>
                                        <option value="UPKK_1A5C2TH">1A5C2TH</option>
                                        <option value="UPKK_1A4C3D">1A4C3D</option>
                                        <option value="UPKK_1A4C2D1TH">1A4C2D1TH</option>
                                        <option value="UPKK_1A4C1D2TH">1A4C1D2TH</option>
                                        <option value="UPKK_1A4C3TH">1A4C3TH</option>
                                        <option value="UPKK_1A3C4D">1A3C4D</option>
                                        <option value="UPKK_1A3C3D1TH">1A3C3D1TH</option>
                                        <option value="UPKK_1A3C2D2TH">1A3C2D2TH</option>
                                        <option value="UPKK_1A3C1D3TH">1A3C1D3TH</option>
                                        <option value="UPKK_1A3C4TH">1A3C4TH</option>
                                        <option value="UPKK_1A2C5D">1A2C5D</option>
                                        <option value="UPKK_1A2C4D1TH">1A2C4D1TH</option>
                                        <option value="UPKK_1A2C3D2TH">1A2C3D2TH</option>
                                        <option value="UPKK_1A2C2D3TH">1A2C2D3TH</option>
                                        <option value="UPKK_1A2C1D4TH">1A2C1D4TH</option>
                                        <option value="UPKK_1A2C5TH">1A2C5TH</option>
                                        <option value="UPKK_1A1C6D">1A1C6D</option>
                                        <option value="UPKK_1A1C5D1TH">1A1C5D1TH</option>
                                        <option value="UPKK_1A1C4D2TH">1A1C4D2TH</option>
                                        <option value="UPKK_1A1C3D3TH">1A1C3D3TH</option>
                                        <option value="UPKK_1A1C2D4TH">1A1C2D4TH</option>
                                        <option value="UPKK_1A1C1D5TH">1A1C1D5TH</option>
                                        <option value="UPKK_1A1C6TH">1A1C6TH</option>
                                        <option value="UPKK_1A7D">1A7D</option>
                                        <option value="UPKK_1A6D1TH">1A6D1TH</option>
                                        <option value="UPKK_1A5D2TH">1A5D2TH</option>
                                        <option value="UPKK_1A4D3TH">1A4D3TH</option>
                                        <option value="UPKK_1A3D4TH">1A3D4TH</option>
                                        <option value="UPKK_1A2D5TH">1A2D5TH</option>
                                        <option value="UPKK_1A1D6TH">1A1D6TH</option>
                                        <option value="UPKK_1A7TH">1A7TH</option>
                                        <option value="UPKK_8B">8B</option>
                                        <option value="UPKK_7B1C">7B1C</option>
                                        <option value="UPKK_7B1D">7B1D</option>
                                        <option value="UPKK_7B1TH">7B1TH</option>
                                        <option value="UPKK_6B2C">6B2C</option>
                                        <option value="UPKK_6B1C1D">6B1C1D</option>
                                        <option value="UPKK_6B1C1TH">6B1C1TH</option>
                                        <option value="UPKK_6B2D">6B2D</option>
                                        <option value="UPKK_6B1D1TH">6B1D1TH</option>
                                        <option value="UPKK_6B2TH">6B2TH</option>
                                        <option value="UPKK_5B3C">5B3C</option>
                                        <option value="UPKK_5B2C1D">5B2C1D</option>
                                        <option value="UPKK_5B2C1TH">5B2C1TH</option>
                                        <option value="UPKK_5B1C2D">5B1C2D</option>
                                        <option value="UPKK_5B1C1D1TH">5B1C1D1TH</option>
                                        <option value="UPKK_5B1C2TH">5B1C2TH</option>
                                        <option value="UPKK_5B3D">5B3D</option>
                                        <option value="UPKK_5B2D1TH">5B2D1TH</option>
                                        <option value="UPKK_5B1D2TH">5B1D2TH</option>
                                        <option value="UPKK_5B3TH">5B3TH</option>
                                        <option value="UPKK_4B4C">4B4C</option>
                                        <option value="UPKK_4B3C1D">4B3C1D</option>
                                        <option value="UPKK_4B3C1TH">4B3C1TH</option>
                                        <option value="UPKK_4B2C2D">4B2C2D</option>
                                        <option value="UPKK_4B2C1D1TH">4B2C1D1TH</option>
                                        <option value="UPKK_4B2C2TH">4B2C2TH</option>
                                        <option value="UPKK_4B1C3D">4B1C3D</option>
                                        <option value="UPKK_4B1C2D1TH">4B1C2D1TH</option>
                                        <option value="UPKK_4B1C1D2TH">4B1C1D2TH</option>
                                        <option value="UPKK_4B1C3TH">4B1C3TH</option>
                                        <option value="UPKK_4B4D">4B4D</option>
                                        <option value="UPKK_4B3D1TH">4B3D1TH</option>
                                        <option value="UPKK_4B2D2TH">4B2D2TH</option>
                                        <option value="UPKK_4B1D3TH">4B1D3TH</option>
                                        <option value="UPKK_4B4TH">4B4TH</option>
                                        <option value="UPKK_3B5C">3B5C</option>
                                        <option value="UPKK_3B4C1D">3B4C1D</option>
                                        <option value="UPKK_3B4C1TH">3B4C1TH</option>
                                        <option value="UPKK_3B3C2D">3B3C2D</option>
                                        <option value="UPKK_3B3C1D1TH">3B3C1D1TH</option>
                                        <option value="UPKK_3B3C2TH">3B3C2TH</option>
                                        <option value="UPKK_3B2C3D">3B2C3D</option>
                                        <option value="UPKK_3B2C2D1TH">3B2C2D1TH</option>
                                        <option value="UPKK_3B2C1D2TH">3B2C1D2TH</option>
                                        <option value="UPKK_3B2C3TH">3B2C3TH</option>
                                        <option value="UPKK_3B1C4D">3B1C4D</option>
                                        <option value="UPKK_3B1C3D1TH">3B1C3D1TH</option>
                                        <option value="UPKK_3B1C2D2TH">3B1C2D2TH</option>
                                        <option value="UPKK_3B1C1D3TH">3B1C1D3TH</option>
                                        <option value="UPKK_3B1C4TH">3B1C4TH</option>
                                        <option value="UPKK_3B5D">3B5D</option>
                                        <option value="UPKK_3B4D1TH">3B4D1TH</option>
                                        <option value="UPKK_3B3D2TH">3B3D2TH</option>
                                        <option value="UPKK_3B2D3TH">3B2D3TH</option>
                                        <option value="UPKK_3B1D4TH">3B1D4TH</option>
                                        <option value="UPKK_3B5TH">3B5TH</option>
                                        <option value="UPKK_2B6C">2B6C</option>
                                        <option value="UPKK_2B5C1D">2B5C1D</option>
                                        <option value="UPKK_2B5C1TH">2B5C1TH</option>
                                        <option value="UPKK_2B4C2D">2B4C2D</option>
                                        <option value="UPKK_2B4C1D1TH">2B4C1D1TH</option>
                                        <option value="UPKK_2B4C2TH">2B4C2TH</option>
                                        <option value="UPKK_2B3C3D">2B3C3D</option>
                                        <option value="UPKK_2B3C2D1TH">2B3C2D1TH</option>
                                        <option value="UPKK_2B3C1D2TH">2B3C1D2TH</option>
                                        <option value="UPKK_2B3C3TH">2B3C3TH</option>
                                        <option value="UPKK_2B2C4D">2B2C4D</option>
                                        <option value="UPKK_2B2C3D1TH">2B2C3D1TH</option>
                                        <option value="UPKK_2B2C2D2TH">2B2C2D2TH</option>
                                        <option value="UPKK_2B2C1D3TH">2B2C1D3TH</option>
                                        <option value="UPKK_2B2C4TH">2B2C4TH</option>
                                        <option value="UPKK_2B1C5D">2B1C5D</option>
                                        <option value="UPKK_2B1C4D1TH">2B1C4D1TH</option>
                                        <option value="UPKK_2B1C3D2TH">2B1C3D2TH</option>
                                        <option value="UPKK_2B1C2D3TH">2B1C2D3TH</option>
                                        <option value="UPKK_2B1C1D4TH">2B1C1D4TH</option>
                                        <option value="UPKK_2B1C5TH">2B1C5TH</option>
                                        <option value="UPKK_2B6D">2B6D</option>
                                        <option value="UPKK_2B5D1TH">2B5D1TH</option>
                                        <option value="UPKK_2B4D2TH">2B4D2TH</option>
                                        <option value="UPKK_2B3D3TH">2B3D3TH</option>
                                        <option value="UPKK_2B2D4TH">2B2D4TH</option>
                                        <option value="UPKK_2B1D5TH">2B1D5TH</option>
                                        <option value="UPKK_2B6TH">2B6TH</option>
                                        <option value="UPKK_1B7C">1B7C</option>
                                        <option value="UPKK_1B6C1D">1B6C1D</option>
                                        <option value="UPKK_1B6C1TH">1B6C1TH</option>
                                        <option value="UPKK_1B5C2D">1B5C2D</option>
                                        <option value="UPKK_1B5C1D1TH">1B5C1D1TH</option>
                                        <option value="UPKK_1B5C2TH">1B5C2TH</option>
                                        <option value="UPKK_1B4C3D">1B4C3D</option>
                                        <option value="UPKK_1B4C2D1TH">1B4C2D1TH</option>
                                        <option value="UPKK_1B4C1D2TH">1B4C1D2TH</option>
                                        <option value="UPKK_1B4C3TH">1B4C3TH</option>
                                        <option value="UPKK_1B3C4D">1B3C4D</option>
                                        <option value="UPKK_1B3C3D1TH">1B3C3D1TH</option>
                                        <option value="UPKK_1B3C2D2TH">1B3C2D2TH</option>
                                        <option value="UPKK_1B3C1D3TH">1B3C1D3TH</option>
                                        <option value="UPKK_1B3C4TH">1B3C4TH</option>
                                        <option value="UPKK_1B2C5D">1B2C5D</option>
                                        <option value="UPKK_1B2C4D1TH">1B2C4D1TH</option>
                                        <option value="UPKK_1B2C3D2TH">1B2C3D2TH</option>
                                        <option value="UPKK_1B2C2D3TH">1B2C2D3TH</option>
                                        <option value="UPKK_1B2C1D4TH">1B2C1D4TH</option>
                                        <option value="UPKK_1B2C5TH">1B2C5TH</option>
                                        <option value="UPKK_1B1C6D">1B1C6D</option>
                                        <option value="UPKK_1B1C5D1TH">1B1C5D1TH</option>
                                        <option value="UPKK_1B1C4D2TH">1B1C4D2TH</option>
                                        <option value="UPKK_1B1C3D3TH">1B1C3D3TH</option>
                                        <option value="UPKK_1B1C2D4TH">1B1C2D4TH</option>
                                        <option value="UPKK_1B1C1D5TH">1B1C1D5TH</option>
                                        <option value="UPKK_1B1C6TH">1B1C6TH</option>
                                        <option value="UPKK_1B7D">1B7D</option>
                                        <option value="UPKK_1B6D1TH">1B6D1TH</option>
                                        <option value="UPKK_1B5D2TH">1B5D2TH</option>
                                        <option value="UPKK_1B4D3TH">1B4D3TH</option>
                                        <option value="UPKK_1B3D4TH">1B3D4TH</option>
                                        <option value="UPKK_1B2D5TH">1B2D5TH</option>
                                        <option value="UPKK_1B1D6TH">1B1D6TH</option>
                                        <option value="UPKK_1B7TH">1B7TH</option>
                                        <option value="UPKK_8C">8C</option>
                                        <option value="UPKK_7C1D">7C1D</option>
                                        <option value="UPKK_7C1TH">7C1TH</option>
                                        <option value="UPKK_6C2D">6C2D</option>
                                        <option value="UPKK_6C1D1TH">6C1D1TH</option>
                                        <option value="UPKK_6C2TH">6C2TH</option>
                                        <option value="UPKK_5C3D">5C3D</option>
                                        <option value="UPKK_5C2D1TH">5C2D1TH</option>
                                        <option value="UPKK_5C1D2TH">5C1D2TH</option>
                                        <option value="UPKK_5C3TH">5C3TH</option>
                                        <option value="UPKK_4C4D">4C4D</option>
                                        <option value="UPKK_4C3D1TH">4C3D1TH</option>
                                        <option value="UPKK_4C2D2TH">4C2D2TH</option>
                                        <option value="UPKK_4C1D3TH">4C1D3TH</option>
                                        <option value="UPKK_4C4TH">4C4TH</option>
                                        <option value="UPKK_3C5D">3C5D</option>
                                        <option value="UPKK_3C4D1TH">3C4D1TH</option>
                                        <option value="UPKK_3C3D2TH">3C3D2TH</option>
                                        <option value="UPKK_3C2D3TH">3C2D3TH</option>
                                        <option value="UPKK_3C1D4TH">3C1D4TH</option>
                                        <option value="UPKK_3C5TH">3C5TH</option>
                                        <option value="UPKK_2C6D">2C6D</option>
                                        <option value="UPKK_2C5D1TH">2C5D1TH</option>
                                        <option value="UPKK_2C4D2TH">2C4D2TH</option>
                                        <option value="UPKK_2C3D3TH">2C3D3TH</option>
                                        <option value="UPKK_2C2D4TH">2C2D4TH</option>
                                        <option value="UPKK_2C1D5TH">2C1D5TH</option>
                                        <option value="UPKK_2C6TH">2C6TH</option>
                                        <option value="UPKK_1C7D">1C7D</option>
                                        <option value="UPKK_1C6D1TH">1C6D1TH</option>
                                        <option value="UPKK_1C5D2TH">1C5D2TH</option>
                                        <option value="UPKK_1C4D3TH">1C4D3TH</option>
                                        <option value="UPKK_1C3D4TH">1C3D4TH</option>
                                        <option value="UPKK_1C2D5TH">1C2D5TH</option>
                                        <option value="UPKK_1C1D6TH">1C1D6TH</option>
                                        <option value="UPKK_1C7TH">1C7TH</option>
                                        <option value="UPKK_8D">8D</option>
                                        <option value="UPKK_7D1TH">7D1TH</option>
                                        <option value="UPKK_6D2TH">6D2TH</option>
                                        <option value="UPKK_5D3TH">5D3TH</option>
                                        <option value="UPKK_4D4TH">4D4TH</option>
                                        <option value="UPKK_3D5TH">3D5TH</option>
                                        <option value="UPKK_2D6TH">2D6TH</option>
                                        <option value="UPKK_1D7TH">1D7TH</option>
                                        <option value="UPKK_8TH">8TH</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tp_bahasa_arab">TP BAHASA ARAB</label>
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
                               
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sudah_penempatan">
                                    <label class="form-check-label">Telah
                                        Ditempatkan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="belum_penempatan">
                                    <label class="form-check-label">Belum
                                        Ditempatkan</label>
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

                        <!--div class="card card-primary">
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
                        </div-->
                    </div--> {{--TUTUP KOLUMN 3--}}


                </div>


                <!-- /.card -->
        </div>

        </div>


    </div>


    <div class="card-footer">
        <button type="submit" class="btn btn-success">Hantar</button>
        <button type="reset" class="btn btn-warning">Set Semula</button>
    </div>
    </form>


</div>
@endsection