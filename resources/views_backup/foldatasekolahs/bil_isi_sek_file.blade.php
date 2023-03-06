@extends('layouts.admin')
@section('content')



@role('administrator')
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link " href="{{route('senaraisekolah.name')}}">Aliran Sekolah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('quotasekolah_kaa.name')}}">Quota Sekolah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active btn-primary" href="{{route('murid_isi.name')}}">Murid Isi</a>
    </li>
</ul>
@endrole
@role('administrator')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th rowspan="2">
                            BIL
                        </th>
                        <th rowspan="2">
                            PPD
                        </th>
                        <th rowspan="2">
                            NAMA SEKOLAH ALIRAN KAA
                        </th>
                        <th width="" colspan="3">
                            KUOTA
                        </th>
                        <th width="" colspan="3">
                            DIISI
                        </th>
                        <th width="" colspan="3">
                            KOSONG
                        </th>
                        <th width="" colspan="3">
                            KURANG/LEBIH
                        </th>
                    </tr>
                    <tr>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($data_kaa_adm as $key => $data)

                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$data->ppd ?? '' }}
                    <td>
                        {{$data->ds_nama_sekolah ?? '' }}
                    </td>
                    <td>
                        {{$data->quota_L_kaa ?? '' }}
                    </td>
                    <td>
                        {{$data->quota_P_kaa ?? '' }}
                    </td>
                    <td>
                        {{$data->quota_L_kaa + $data->quota_P_kaa }}
                    </td>

                    <td>
                        {{$data->JUM_LELAKI ?? '' }}
                    </td>
                    <td>
                        {{$data->JUM_PEREMPUAN ?? '' }}
                    </td>
                    <td>
                        {{$data->JUM_LELAKI+ $data->JUM_PEREMPUAN}}
                    </td>

                    <td>
                        {{$data->quota_L_kaa-$data->JUM_LELAKI }}
                    </td>
                    <td>
                        {{$data->quota_P_kaa-$data->JUM_PEREMPUAN}}
                    </td>
                    <td>
                        {{$data->quota_L_kaa-$data->JUM_LELAKI + $data->quota_P_kaa-$data->JUM_PEREMPUAN}}
                    </td>
                    <td>
                        @if (($data->JUM_LELAKI - $data->quota_L_kaa) > 0 )
                        <span style="color: red; font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_kaa}}</span>
                        @else
                        <span style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_kaa}}</span>
                        @endif
                    </td>

                    <td>
                        @if (($data->JUM_PEREMPUAN - $data->quota_P_kaa) > 0)
                        <span
                            style="color: red; font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_kaa}}</span>
                        @else
                        <span
                            style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_kaa}}</span>
                        @endif
                    <td>
                        <span
                            style="color: rgb(0, 26, 255); font-weight: bold;">{{($data->JUM_LELAKI - $data->quota_L_kaa ) + ($data->JUM_PEREMPUAN - $data->quota_P_kaa)}}</span>
                    </td>

                    </tr>
                    @endforeach
                </tbody>
                <BR>
                <thead>
                    <tr>
                        <th rowspan="2">
                            BIL
                        </th>
                        <th rowspan="2">
                            PPD
                        </th>
                        <th width="" rowspan="2">
                            NAMA SEKOLAH ALIRAN SABK DINI
                        </th>
                        <th width="" colspan="3">
                            KUOTA
                        </th>
                        <th width="" colspan="3">
                            DIISI
                        </th>
                        <th width="" colspan="3">
                            KOSONG
                        </th>
                        <th width="" colspan="3">
                            KURANG/LEBIH
                        </th>
                    </tr>
                    <tr>

                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>

                    </tr>

                </thead>
                <tbody>
                    @foreach($data_sabk_dini_adm as $key => $data)
                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{$data->ppd ?? '' }}
                        </td>
                        <td>
                            {{$data->ds_nama_sekolah ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_dini ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_dini ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_dini + $data->quota_P_sabk_dini }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_PEREMPUAN ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI+ $data->JUM_PEREMPUAN}}
                        </td>

                        <td>
                            {{$data->quota_L_sabk_dini-$data->JUM_LELAKI }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_dini-$data->JUM_PEREMPUAN}}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_dini-$data->JUM_LELAKI + $data->quota_P_sabk_dini-$data->JUM_PEREMPUAN}}
                        </td>
                       
                        <td>
                            @if (($data->JUM_LELAKI - $data->quota_L_sabk_dini) > 0 )
                            <span
                                style="color: red; font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_dini}}</span>
                            @else
                            <span
                                style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_dini}}</span>
                            @endif
                        </td>
                        <td>
                            @if (($data->JUM_PEREMPUAN - $data->quota_P_sabk_dini) > 0)
                            <span
                                style="color: red; font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_dini}}</span>
                            @else
                            <span
                                style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_dini}}</span>
                            @endif
                        <td>
                            <span
                                style="color: rgb(0, 26, 255); font-weight: bold;">{{($data->JUM_LELAKI - $data->quota_L_sabk_dini ) + ($data->JUM_PEREMPUAN - $data->quota_P_sabk_dini)}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th rowspan="2">
                            BIL
                        </th>
                        <th rowspan="2">
                            PPD
                        </th>
                        <th width="" rowspan="2">
                            NAMA SEKOLAH ALIRAN SABK TAHFIZ
                        </th>
                        <th width="" colspan="3">
                            KUOTA
                        </th>
                        <th width="" colspan="3">
                            DIISI
                        </th>
                        <th width="" colspan="3">
                            KOSONG
                        </th>
                        <th width="" colspan="3">
                            KURANG/LEBIH
                        </th>
                    </tr>
                    <tr>

                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data_sabk_tahfiz_adm as $key => $data)

                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{$data->ppd ?? '' }}
                        </td>
                        <td>
                            {{$data->ds_nama_sekolah ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_tahfiz ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_tahfiz ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_tahfiz + $data->quota_P_sabk_tahfiz }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_PEREMPUAN ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI+ $data->JUM_PEREMPUAN}}
                        </td>

                        <td>
                            {{$data->quota_L_sabk_tahfiz-$data->JUM_LELAKI }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_tahfiz-$data->JUM_PEREMPUAN}}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_tahfiz-$data->JUM_LELAKI + $data->quota_P_sabk_tahfiz-$data->JUM_PEREMPUAN}}
                        </td>
                        
                        <td>                        
                            @if (($data->JUM_LELAKI - $data->quota_L_sabk_tahfiz ) > 0 )
                                <span style="color: red; font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_tahfiz }}</span>
                            @else
                                <span style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_tahfiz }}</span>
                            @endif                           
                    </td>

                    <td>          
                            @if (($data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz ) > 0)
                                <span style="color: red; font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz }}</span>
                            @else
                                <span style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz }}</span>
                            @endif
                    <td>
                            <span style="color: rgb(0, 26, 255); font-weight: bold;">{{($data->JUM_LELAKI - $data->quota_L_sabk_tahfiz  ) + ($data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz )}}</span>                     
                    </td>



                    </tr>
                    @endforeach
                </tbody>






            </table>
        </div>
    </div>
</div>

@endrole
@role('ppd')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th rowspan="2">
                            BIL
                        </th>
                        <th rowspan="2">
                            PPD
                        </th>
                        <th rowspan="2">
                            NAMA SEKOLAH ALIRAN KAA
                        </th>
                        <th width="" colspan="3">
                            KUOTA
                        </th>
                        <th width="" colspan="3">
                            DIISI
                        </th>
                        <th width="" colspan="3">
                            KOSONG
                        </th>
                        <th width="" colspan="3">
                            KURANG/LEBIH
                        </th>
                    </tr>
                    <tr>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($data_kaa as $key => $data)

                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$data->ppd ?? '' }}
                    <td>
                        {{$data->ds_nama_sekolah ?? '' }}
                    </td>
                    <td>
                        {{$data->quota_L_kaa ?? '' }}
                    </td>
                    <td>
                        {{$data->quota_P_kaa ?? '' }}
                    </td>
                    <td>
                        {{$data->quota_L_kaa + $data->quota_P_kaa }}
                    </td>

                    <td>
                        {{$data->JUM_LELAKI ?? '' }}
                    </td>
                    <td>
                        {{$data->JUM_PEREMPUAN ?? '' }}
                    </td>
                    <td>
                        {{$data->JUM_LELAKI+ $data->JUM_PEREMPUAN}}
                    </td>

                    <td>
                        {{$data->quota_L_kaa-$data->JUM_LELAKI }}
                    </td>
                    <td>
                        {{$data->quota_P_kaa-$data->JUM_PEREMPUAN}}
                    </td>
                    <td>
                        {{$data->quota_L_kaa-$data->JUM_LELAKI + $data->quota_P_kaa-$data->JUM_PEREMPUAN}}
                    </td>
                    <td>
                        @if (($data->JUM_LELAKI - $data->quota_L_kaa) > 0 )
                        <span style="color: red; font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_kaa}}</span>
                        @else
                        <span style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_kaa}}</span>
                        @endif
                    </td>

                    <td>
                        @if (($data->JUM_PEREMPUAN - $data->quota_P_kaa) > 0)
                        <span
                            style="color: red; font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_kaa}}</span>
                        @else
                        <span
                            style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_kaa}}</span>
                        @endif
                    <td>
                        <span
                            style="color: rgb(0, 26, 255); font-weight: bold;">{{($data->JUM_LELAKI - $data->quota_L_kaa ) + ($data->JUM_PEREMPUAN - $data->quota_P_kaa)}}</span>
                    </td>

                    </tr>
                    @endforeach
                </tbody>
                <BR>
                <thead>
                    <tr>
                        <th rowspan="2">
                            BIL
                        </th>
                        <th rowspan="2">
                            PPD
                        </th>
                        <th width="" rowspan="2">
                            NAMA SEKOLAH ALIRAN SABK DINI
                        </th>
                        <th width="" colspan="3">
                            KUOTA
                        </th>
                        <th width="" colspan="3">
                            DIISI
                        </th>
                        <th width="" colspan="3">
                            KOSONG
                        </th>
                        <th width="" colspan="3">
                            KURANG/LEBIH
                        </th>
                    </tr>
                    <tr>

                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>

                    </tr>

                </thead>
                <tbody>
                    @foreach($data_sabk_dini as $key => $data)
                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{$data->ppd ?? '' }}
                        </td>
                        <td>
                            {{$data->ds_nama_sekolah ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_dini ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_dini ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_dini + $data->quota_P_sabk_dini }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_PEREMPUAN ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI+ $data->JUM_PEREMPUAN}}
                        </td>

                        <td>
                            {{$data->quota_L_sabk_dini-$data->JUM_LELAKI }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_dini-$data->JUM_PEREMPUAN}}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_dini-$data->JUM_LELAKI + $data->quota_P_sabk_dini-$data->JUM_PEREMPUAN}}
                        </td>
                       
                        <td>
                            @if (($data->JUM_LELAKI - $data->quota_L_sabk_dini) > 0 )
                            <span
                                style="color: red; font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_dini}}</span>
                            @else
                            <span
                                style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_dini}}</span>
                            @endif
                        </td>
                        <td>
                            @if (($data->JUM_PEREMPUAN - $data->quota_P_sabk_dini) > 0)
                            <span
                                style="color: red; font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_dini}}</span>
                            @else
                            <span
                                style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_dini}}</span>
                            @endif
                        <td>
                            <span
                                style="color: rgb(0, 26, 255); font-weight: bold;">{{($data->JUM_LELAKI - $data->quota_L_sabk_dini ) + ($data->JUM_PEREMPUAN - $data->quota_P_sabk_dini)}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th rowspan="2">
                            BIL
                        </th>
                        <th rowspan="2">
                            PPD
                        </th>
                        <th width="" rowspan="2">
                            NAMA SEKOLAH ALIRAN SABK TAHFIZ
                        </th>
                        <th width="" colspan="3">
                            KUOTA
                        </th>
                        <th width="" colspan="3">
                            DIISI
                        </th>
                        <th width="" colspan="3">
                            KOSONG
                        </th>
                        <th width="" colspan="3">
                            KURANG/LEBIH
                        </th>
                    </tr>
                    <tr>

                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>
                        <th>
                            L
                        </th>
                        <th>
                            P
                        </th>
                        <th>
                            J
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data_sabk_tahfiz as $key => $data)

                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{$data->ppd ?? '' }}
                        </td>
                        <td>
                            {{$data->ds_nama_sekolah ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_tahfiz ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_tahfiz ?? '' }}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_tahfiz + $data->quota_P_sabk_tahfiz }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_PEREMPUAN ?? '' }}
                        </td>
                        <td>
                            {{$data->JUM_LELAKI+ $data->JUM_PEREMPUAN}}
                        </td>

                        <td>
                            {{$data->quota_L_sabk_tahfiz-$data->JUM_LELAKI }}
                        </td>
                        <td>
                            {{$data->quota_P_sabk_tahfiz-$data->JUM_PEREMPUAN}}
                        </td>
                        <td>
                            {{$data->quota_L_sabk_tahfiz-$data->JUM_LELAKI + $data->quota_P_sabk_tahfiz-$data->JUM_PEREMPUAN}}
                        </td>
                        
                        <td>                        
                            @if (($data->JUM_LELAKI - $data->quota_L_sabk_tahfiz ) > 0 )
                                <span style="color: red; font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_tahfiz }}</span>
                            @else
                                <span style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_LELAKI - $data->quota_L_sabk_tahfiz }}</span>
                            @endif                           
                    </td>

                    <td>          
                            @if (($data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz ) > 0)
                                <span style="color: red; font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz }}</span>
                            @else
                                <span style="color: rgb(0, 255, 0); font-weight: bold;">{{$data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz }}</span>
                            @endif
                    <td>
                            <span style="color: rgb(0, 26, 255); font-weight: bold;">{{($data->JUM_LELAKI - $data->quota_L_sabk_tahfiz  ) + ($data->JUM_PEREMPUAN - $data->quota_P_sabk_tahfiz )}}</span>                     
                    </td>



                    </tr>
                    @endforeach
                </tbody>






            </table>
        </div>
    </div>
</div>

@endrole

@endsection