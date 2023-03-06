@extends('layouts.admin')
@section('content')

<div class="card-header bg-primary">
    <h5>MODUL PENEMPATAN</h5>
</div>
<div class="card">
    
  

    
<div>
    <div class="card-body">
        <div class="card">
            @if (Auth::user()->kod_organisasi != 'jpnm')
            <h6> SILA PILIH SEKOLAH PENEMPATAN:</h6>
            <select class="form-select" id="ddlFruits" onchange="GetSelectedTextValue(this)">
               
                <option value=""></option>
                <option value=">>">BATALKAN PEMILIHAN</option>
                @foreach ( $listsekolahpilihan_kaa as $ps )
                <option value="KAA>{{$ps->kod_sekolah}}>{{$ps->ds_nama_sekolah}}">KAA>{{$ps->ppd}}>{{$ps->kod_sekolah}} >
                    {{$ps->ds_nama_sekolah}} 
                    | Kuota: {{$ps->quota_L_kaa + $ps->quota_P_kaa}}
                    | KL: {{$ps->quota_L_kaa }}
                    | KP: {{$ps->quota_P_kaa}}
                    | Isi L:{{$ps->JUM_LELAKI}}| Isi P:{{$ps->JUM_PEREMPUAN}} 
                    | Kosong:{{$ps->BEZA_L+$ps->BEZA_P}} |</option>
                @endforeach
    
                @foreach ( $listsekolahpilihan_sabk_dini as $ps )
                <option value="DINI>{{$ps->kod_sekolah}}>{{$ps->ds_nama_sekolah}}">DINI>{{$ps->ppd}}>{{$ps->kod_sekolah}} >
                    {{$ps->ds_nama_sekolah}} 
                    | Kuota: {{$ps->quota_L_sabk_dini+$ps->quota_P_sabk_dini}} 
                    | KL:   {{$ps->quota_L_sabk_dini}}
                    | KP:   {{$ps->quota_P_sabk_dini}} 
                    | Isi L:{{$ps->JUM_LELAKI}}
                    | Isi P:{{$ps->JUM_PEREMPUAN}} | Kosong L:{{$ps->BEZA_L+$ps->BEZA_P}} |</option>
                @endforeach
    
                @foreach ( $listsekolahpilihan_sabk_tahfiz as $ps )
                <option value="TAHFIZ>{{$ps->kod_sekolah}}>{{$ps->ds_nama_sekolah}}">TAHFIZ>{{$ps->ppd}}>{{$ps->kod_sekolah}} >
                    {{$ps->ds_nama_sekolah}} 
                    | Kuota: {{$ps->quota_L_sabk_tahfiz+$ps->quota_P_sabk_tahfiz}} 
                    | KL:   {{$ps->quota_L_sabk_tahfiz}}
                    | KP:   {{$ps->quota_P_sabk_tahfiz}} 
                    | Isi L:{{$ps->JUM_LELAKI}}
                    |Isi P:{{$ps->JUM_PEREMPUAN}} | Kosong L:{{$ps->BEZA_L+$ps->BEZA_P}} |</option>
                @endforeach
            </select>
            @endif


        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="">

                        </th>
                        
                        <th width="3">
                            ID
                        </th>
                        <!--th width="3">
                            PPD
                        </th-->
                        <th >
                            PENEMPATAN
                        </th>
                        <th>
                            MERIT
                        </th>
                        <th >
                            B.ARAB J-QAF
                        </th>
                        <th >
                            B.ARAB L-Q
                        </th>
                        <!--th >
                            ALIRAN
                        </th-->
                        <th>
                            CALON
                        </th>
                        <th>
                            NOKP
                        </th>
                        <th >
                            J
                        </th>
                        
                        <th >
                            SEK.P1
                        </th>
                        <th >
                            SEK.P2
                        </th>
                        <th >
                            SEK.P3
                        </th>
                        
                        <th >
                            SR
                        </th>
                        <th >
                            ALAMAT
                        </th>
                        <th >
                            SR1
                        </th>
                        <th >
                            SR2
                        </th>
                        <th >
                            PANEL
                        </th>
                      
                        
                        
                        
                        
                    </tr>
                </thead>
                <tbody>
                  {{--  (array_merge($array1,$array2) as $item) --}}
                    
                     {{--   @foreach (array_merge($datamurids,$pbd) as $key =>$datamurid) --}}
                   
                        @foreach($datamurids as $key => $datamurid) 
                        <tr data-entry-id="{{ $datamurid->id }}">
                            <td>

                            </td>
                            
                            <td>
                             <b>{{  $key + $datamurids->firstItem()}}</b>
                            </td>
                            {{--
                            <td>
                             
                               @if ($datamurid->PPD_DM == 'PPD ALOR GAJAH')
                                <span>
                                    <i>AG</i>
                                </span>
                                @elseif ($datamurid->PPD_DM == 'PPD MELAKA TENGAH')
                                <span>
                                 <i>MT</i>
                                </span>      
                                 @else
                                <span class="icon">
                                    <i>JSN</i>                      
                                </span>
                                @endif
                            </td>--}}
                           
                            <td>
                                <p class="badge badge-success text-wrap">{{ $datamurid->PENEMPATAN ??''}}</p>
                            </td>
                            <td>
                                <div>  {{--number_format($datamurid->jumlah,1)--}}</div> 
                                <p class="badge badge-warning text-wrap">{{number_format($datamurid->point,2)}}</p> 
                            </td>
                            <td>
                                <p class="badge badge-warning text-wrap">{{ $datamurid->BAHASA_ARAB ?? '' }}</p>
                            </td>
                            <td>
                                <p class="badge badge-warning text-wrap">{{ $datamurid->LUGHATULQURAN ?? '' }}</p>
                            </td>
                            <!--td>
                                <div class="badge badge- text-wrap" style="width: 6rem;">  {{$datamurid->ALIRAN_PENEMPATAN ??''}}</div>
                            </td-->
                            <td>
                                <p class="badge badge-primary text-wrap" style="width: 10rem;">{{ $datamurid->NAMA ?? '' }}</p>
                            </td>
                            <td>
                                <p class="badge badge-primary text-wrap">{{ $datamurid->NOKP ?? '' }}</p>
                            </td-->
                            <td>
                                <p class="badge badge-primary text-wrap">{{ $datamurid->KOD_JANTINA ?? '' }}</p>
                             {{--   <div class="badge badge text-wrap" >
                                    @if ($datamurid->KOD_JANTINA == 'L')
                                    <span class="icon">
                                        <i class="fas fa-male fa-3x" style="color:rgb(26, 243, 232)"></i>
                                    </span>
                              @else
                                    <span class="icon">
                                        <i class="fas fa-female fa-3x" style="color:rgb(248, 32, 140)"></i>                      
                                    </span>
                           @endif
                                </div> 
                                --}}
                            </td>
                            
                            <td> 
                           

                                <p class="badge badge-success text-wrap">{{ $datamurid->NAMA_SEKOLAH_P1?? '' }}</p>
                                <p class="badge badge-warning text-wrap">{{ $datamurid->PILIHAN_1?? '' }}</p>
                               <!--      @if ($datamurid->PPD_SP1 == 'M030')
                                    <i>AG</i>
                                    </span>
                                    @elseif ($datamurid->PPD_SP1 == 'M020')
                                    <span><i>MT</i>
                                    </span>      
                                     @elseif ($datamurid->PPD_SP1 == 'M010')
                                    <span><i>JASIN</i>
                                     @else
                                    <span class="icon">
                                    <i></i>                        
                                    </span>
                                    @endif   -->
                                     
                            </td>
                            <td>
                                <p class="badge badge-success text-wrap">{{ $datamurid->NAMA_SEKOLAH_P2??''}}</p>
                                <p class="badge badge-warning text-wrap">{{$datamurid->PILIHAN_2?? '' }}</p>
                                  <!--  @if ($datamurid->PPD_SP2 == 'M030')
                                    <i>AG</i>
                                    
                                    @elseif ($datamurid->PPD_SP2 == 'M020')
                                    <i>MT</i>
                                         
                                     @elseif ($datamurid->PPD_SP2 == 'M010')
                                    <i>JASIN</i>
                                     @else
        
                                    <i></i>                        
                                    
                                    @endif  -->
                                    
                            </td>
                            <td>
                                <p class="badge badge-success text-wrap">{{$datamurid->NAMA_SEKOLAH_P3?? '' }}</p>
                                <p class="badge badge-warning text-wrap">{{$datamurid->PILIHAN_3?? '' }}</p>
                                  <!--@if ($datamurid->PPD_SP3 == 'M030')
                                    <span><i>AG</i>
                                    </span>
                                    @elseif ($datamurid->PPD_SP3 == 'M020')
                                    <span><i>MT</i>
                                    </span>      
                                     @elseif ($datamurid->PPD_SP3 == 'M010')
                                    <span><i>JASIN</i>
                                     @else
                                    <span class="icon">
                                    <i></i>                        
                                    </span>
                                    @endif-->
                                    
                            </td>
                            
                            <td>
                                <p class="badge badge-warning text-wrap">{{ $datamurid->NAMA_SEKOLAH ?? '' }}</p>
                            </td>
                            <td>
                                
                                    <p class="badge badge-info text-wrap" style = "width: 9rem;">{{ $datamurid->ALAMAT_MURID ?? '' }}<br>{{ $datamurid->BANDAR ?? '' }}<br>{{ $datamurid->POSKOD ?? '' }}<br>{{ $datamurid->NEGERI ?? '' }}</P>
                                
                                <!--p class="badge badge-info text-wrap" style = "width: 9rem;">{{ $datamurid->ALAMAT_MURID ?? '' }}</p-->
                            </td>
                            <td><p class="badge badge-warning text-wrap">{{$datamurid->NAMA_SR1?? '' }}</p>
                             </td>
                             <td><p class="badge badge-warning text-wrap">{{$datamurid->NAMA_SR2?? '' }}</p>
                             </td>

                            <td>
                                @if ($datamurid->PENEMPATAN != '')
                               <p class="badge badge-success text-wrap">
                                    {{ $datamurid->PEGAWAI_PELULUS ??''}}</p>
                                    
                               <p class="badge badge-warning text-wrap">
                                    {{\Carbon\Carbon::parse($datamurid->updated_at)->format('d/m/Y')}}</p>
                               </p>    
                              
                               
                                @else

                                @endif
                                   
                                  
                               
                                    {{-- $datamurid->updated_at ??''--}}
                                    {{-- \Carbon\Carbon::parse($datamurid->updated_at)->format('d/m/Y, H:i:s')--}}
                                 
                            </td>
                           
                           
                            

                            <!--td>
                                <div class="badge badge-success text-wrap" style="width: 10rem;">  {{ $datamurid->NAMA_SEKOLAH_MEN_LULUS?? '' }}</div>
                            </td-->
                            <!--td>
                               <a class="btn btn-xs btn-primary" href="{{ route('datamurids.show', $datamurid->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('datamurids.edit', $datamurid->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('datamurids.destroy', $datamurid->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td-->

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        </div>
    
    </div>
</div>
@endsection

<!--style>
    .hide {
         display: none;
     }
 
     .myDIV:active+.hide {
         display: block;
         color: rgb(235, 85, 26);
     }
 </style-->

@section('scripts')
@parent

<script>
    function GetSelectedTextValue(ddlFruits) {             
                    var selectedValue = ddlFruits.value;
                    alert(" NAMA SEKOLAH DIPILIH: " + selectedValue);
                }
        $(function () {
      let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
      let deleteButtonTrans = 'SIMPAN'
      let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('datamurids.mass_update') }}",
        className: 'btn-warning',
        action: function (e, dt, node, config) {
        var pilih_sekolah = ddlFruits.value;
          var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
          });
    
            if (ids.length === 0) {
            alert('Sila Pilih Nama Murid Dan Sekolah!')
            return
          }
          if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
              headers: {'x-csrf-token': _token},
              method: 'POST',
              url: config.url,
              data: { ids: ids, pilihSekolah: pilih_sekolah, _method: 'POST' }})
              .done(function () { location.reload() })
          }
        }
      }
      dtButtons.push(deleteButton)
    
      $.extend(true, $.fn.dataTable.defaults, {
        order: [[ 3, 'desc' ]],
        pageLength: 50,
      });
      $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        });
    })
    
    </script>



@endsection
