@extends('layouts.admin')

@section('content')
<div class="card-header bg-primary">
    <h6>MODUL PENETAPAN KOUTA SEKOLAH</h6>
</div>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="{{route('senaraisekolah.name')}}">Aliran Sekolah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active btn-primary" href="{{route('quotasekolah_kaa.name')}}">Quota Sekolah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('murid_isi.name')}}">Murid Isi</a>
    </li>
</ul>

<div class="w-full mt-8 bg-white rounded">

    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a class="nav-link active btn-primary" href="{{route('quotasekolah_kaa.name')}}">KAA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('quotasekolah_dini.name')}}">SABK-DINI</a>
        <li class="nav-item">
            <a class="nav-link" href="{{route('quotasekolah_tahfiz.name')}}">SABK-TAHFIZ</a>
        </li>
        </li>
    </ul>
    <form action="{{route('bilquota_kaa.name')}}" method="POST">

        <div class="mt-6">
            <button
                class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text font-bold py-2 px-4 rounded"
                type="submit">
                Simpan
            </button>
        </div>
        <div class="card">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">PPD</th>
                        <th scope="col">KOD</th>
                        <th scope="col">NAMA SEKOLAH</th>
                        <th scope="col">ALIRAN</th>
                        <th scope="col">KUOTA L KAA</th>
                        <th scope="col">KUOTA P KAA</th>
                        <th scope="col">JUMLAH QUOTA KAA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>@foreach ($quota_kaa as $key =>$dm)
                        @csrf
                        <th scope="row">{{  $key + $quota_kaa->firstItem()}}</th>
                        <th>{{ $dm->ppd }} </th>
                        <th>{{ $dm->kod_sekolah }}</th>
                        <th>{{ $dm->ds_nama_sekolah }}</th>
                        <th>{{ $dm->sekolah_kaa }}</th>

                        <td> <input type="number" id="quota_L_kaa[{{$dm->id}}]" name="quota_L_kaa[{{$dm->id}}]"
                                class="form-control" value="{{$dm->quota_L_kaa}}" {{$dm->sekolah_jantina_L == '' ? 'readonly' : ''}} />
                        </td>
                        <td><input type="number" id="quota_P_kaa[{{$dm->id}}]" name="quota_P_kaa[{{$dm->id}}]"
                                class="form-control" value="{{$dm->quota_P_kaa}}" {{$dm->sekolah_jantina_P == '' ? 'readonly' : ''}} />
                        </td>
                        <td><input type="text" id="quota_LP_kaa[{{$dm->id}}]" name="quota_LP_kaa[{{$dm->id}}]"
                                class="form-control" value="{{$dm->quota_L_kaa+$dm->quota_P_kaa}}" disabled>
                        </td>
                    </tr>@endforeach

                </tbody>
            </table>
        </div>
    </form>
</div>
</div>
</div>
@endsection