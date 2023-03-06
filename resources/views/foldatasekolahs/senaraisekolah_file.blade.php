@extends('layouts.admin')

@section('content')

<div class="card-header bg-primary">
    <h6>MODUL PENETAPAN ALIRAN SEKOLAH</h6>
</div>
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active btn-primary" href="{{route('senaraisekolah.name')}}">Aliran Sekolah</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('quotasekolah_kaa.name')}}">Quota Sekolah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('murid_isi.name')}}">Murid Isi</a>
      </li>
  </ul>


<div class="w-full mt-8 bg-white rounded">

    <div class="w-full px-6 py-6">

        <form action="{{ route('aliransimpan_kaa.name') }}" method="POST">

            <div class="mt-6">
                <button
                    class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text font-bold py-2 px-4 rounded"
                    type="submit">
                    Simpan Aliran
                </button>
            </div>

            <div class="card text-center">
                <h3>ALIRAN SEKOLAH</h3>
                <div>
                    <div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                                    <thead>
                                        <tr>
                                            <th width="10">
                                                BIL
                                            </th>
                                            <th>
                                                PPD
                                            </th>
                                            <th>
                                                NAMA SEKOLAH
                                            </th>
                                            <th>
                                                JENIS
                                            </th>
                                            <th colspan="2">
                                                JANTINA
                                            </th>
                                            <th>
                                                SMK
                                            </th>
                                            <th colspan="2">
                                                SABK
                                            </th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($datasekolah as $index => $ds)
                                        <tr data-entry-id="{{ $ds->id }}">
                                            @csrf
                                            <td>{{$index+1}} </td>
                                            <td align=left>{{$ds->ppd}} </td>
                                            <td align=left>{{$ds->ds_nama_sekolah}} </td>
                                            <td>{{$ds->JenisSekolah}} </td>
                                            <td>
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input type="hidden" name="sekolah_jantina_L[{{$ds->id}}]" value="">
                                                    <input name="sekolah_jantina_L[{{$ds->id}}]" class="leading-tight"
                                                        type="checkbox" value="L"
                                                        {{$ds->sekolah_jantina_L == 'L' ? 'checked' : ''}}>
                                                    <span class="text-sm">L</span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input type="hidden" name="sekolah_jantina_P[{{$ds->id}}]" value="">
                                                    <input name="sekolah_jantina_P[{{$ds->id}}]" class="leading-tight"
                                                        type="checkbox" value="P"
                                                        {{$ds->sekolah_jantina_P == 'P' ? 'checked' : ''}}>
                                                    <span class="text-sm">P</span>
                                                </label></td>
                                            <td>
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input type="hidden" name="sekolah_kaa[{{$ds->id}}]" value="">
                                                    <input name="sekolah_kaa[{{$ds->id}}]" class="leading-tight"
                                                        type="checkbox" value="KAA"
                                                        {{$ds->sekolah_kaa == 'KAA' ? 'checked' : ''}}>
                                                    <a>KAA</a>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input type="hidden" name="sekolah_sabk_dini[{{$ds->id}}]" value="">
                                                    <input name="sekolah_sabk_dini[{{$ds->id}}]" class="leading-tight"
                                                        type="checkbox" value="DINI"
                                                        {{$ds->sekolah_sabk_dini == 'DINI' ? 'checked' : ''}}>
                                                    <a>DINI</a>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input type="hidden" name="sekolah_sabk_tahfiz[{{$ds->id}}]"
                                                        value="">
                                                    <input name="sekolah_sabk_tahfiz[{{$ds->id}}]" class="leading-tight"
                                                        type="checkbox" value="TAHFIZ"
                                                        {{$ds->sekolah_sabk_tahfiz == 'TAHFIZ' ? 'checked' : ''}}>
                                                    <a>TAHF</a>
                                                </label>
                                            </td>
                                            <input type="hidden" name="class_id" value="{{-- $student->class_id --}}">
                                            <input type="hidden" name="teacher_id" value="{{-- $class->teacher_id --}}">

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button
                            class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text font-bold py-2 px-4 rounded"
                            type="submit">
                            Simpan Aliran
                        </button>
                    </div>
        </form>
    </div>
</div>



@endsection