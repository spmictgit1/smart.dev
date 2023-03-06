@extends('layouts.admin')
@section('content')


<div class="card">
    
  

    
<div>
    <div class="card-body">
        <div class="card">
            <h4> SILA PILIH SEKOLAH PENEMPATAN:</h4>
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
    


        <div class="table-responsive-sm">
            <table class="table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="">

                        </th>
                        
                        <!--th width="3">
                            ID
                        </th-->
                        <!--th width="3">
                            PPD
                        </th-->
                        <th width="3" >
                            <b>PENEMPATAN<b>
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
                            AGAMA
                        </th>
                        <th >
                            PILIHAN-1
                        </th>
                        <th >
                            PILIHAN-2
                        </th>
                        <th >
                            PILIHAN-3
                        </th>
                        
                        <th>
                            %
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
                            
                            <!--td>
                             <p>  <div class="badge badge text-wrap" style="width: 3rem;">{{ $datamurid->id ?? '' }} </p></td>
                            </td-->
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
                               <b> {{$datamurid->PENEMPATAN ??''}}</b>
                            </td>
                            <!--td>
                                <div class="badge badge- text-wrap" style="width: 6rem;">  {{$datamurid->ALIRAN_PENEMPATAN ??''}}</div>
                            </td-->
                            <td>
                                <div >  {{ $datamurid->NAMA ?? '' }}</div>
                            </td>
                            <td>
                                <div>{{ $datamurid->NOKP ?? '' }}</div>
                            </td-->
                            <td>
                                <div >  {{ $datamurid->KOD_JANTINA ?? '' }}</div>
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
                            {{ $datamurid->AGAMA ?? '' }}
                            </td>
                            <td> 
                           

                                <div> {{ $datamurid->NAMA_SEKOLAH_P1?? '' }}<br>
                                     @if ($datamurid->KOD_PPD_SP1 == 'M030')
                                    <span><i>AG</i>
                                    </span>
                                    @elseif ($datamurid->KOD_PPD_SP1 == 'M020')
                                    <span><i>MT</i>
                                    </span>      
                                     @elseif ($datamurid->KOD_PPD_SP1 == 'M010')
                                    <span><i>JASIN</i>
                                     @else
                                    <span class="icon">
                                    <i></i>                        
                                    </span>
                                    @endif</div>
                                    <div>{{ $datamurid->PILIHAN_1?? '' }}</div> 
                            </td>
                            <td>
                                <div>{{ $datamurid->NAMA_SEKOLAH_P2?? '' }}<br> 
                                    @if ($datamurid->KOD_PPD_SP2 == 'M030')
                                    <span><i>AG</i>
                                    </span>
                                    @elseif ($datamurid->KOD_PPD_SP2 == 'M020')
                                    <span><i>MT</i>
                                    </span>      
                                     @elseif ($datamurid->KOD_PPD_SP2 == 'M010')
                                    <span><i>JASIN</i>
                                     @else
                                    <span class="icon">
                                    <i></i>                        
                                    </span>
                                    @endif</div>
                                    <div>{{ $datamurid->PILIHAN_2?? '' }}</div><br>
                            </td>
                            <td>
                                <div>{{ $datamurid->NAMA_SEKOLAH_P3?? '' }}<br> 
                                    @if ($datamurid->KOD_PPD_SP3 == 'M030')
                                    <span><i>AG</i>
                                    </span>
                                    @elseif ($datamurid->KOD_PPD_SP3 == 'M020')
                                    <span><i>MT</i>
                                    </span>      
                                     @elseif ($datamurid->KOD_PPD_SP3 == 'M010')
                                    <span><i>JASIN</i>
                                     @else
                                    <span class="icon">
                                    <i></i>                        
                                    </span>
                                    @endif</div>
                                    <div>{{ $datamurid->PILIHAN_3?? '' }}</div>
                            </td>
                            
                            <td>
                                <div class="badge badge text-wrap" >  {{--number_format($datamurid->jumlah,1)--}}</div> 
                                <div >  {{$datamurid->point}}</div> 
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
          data: { ids: ids, pilihSekolah: pilih_sekolah, _method: 'POST' }
		  })
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 7, 'desc' ]],
    pageLength: 50,
  });
  
  $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
      
    });
    
    $test=pilih_sek_rendah;
})

</script>



@endsection
