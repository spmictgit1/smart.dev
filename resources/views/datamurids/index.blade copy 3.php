@extends('layouts.admin')
@section('content')



<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("datamurids.create") }}">
            TAMBAH CALON
        </a>
        <a class="btn btn-warning" href="{{route("filter")}}">
            TAPIS CALON
        </a>
        {{-- Auth::user()->name --}}
        {{-- Auth::user()->email --}}
        <div class="col">
            <div class= "text-value">{{count($alldatamurid)}} CALON </div>
          </div>
    </div>
</div>
<div class="card">
    <div class="col-sm-6 col-lg-4">
        <!--div class="card" style="max-width: 8rem;">
          <div class="card-header bg-dribbble content-center">
            <i class="far fa-folder-open icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">89k</div>
              <div class="text-uppercase text">friends</div>
            </div>
            
          </div>
        </div-->

      </div>



      <div class="card-body">
        
       <h4> SILA PILIH SEKOLAH PENEMPATAN:</h4>
        <select id="ddlFruits" onchange="GetSelectedTextValue(this)">
           
            <option value=""></option>
            <option value=">>">BATALKAN PEMILIHAN</option>
            @foreach ( $listsekolahpilihan_kaa as $ps )
            <option value="KAA>{{$ps->kod_sekolah}}>{{$ps->ds_nama_sekolah}}">KAA>{{$ps->kod_sekolah}} >
                {{$ps->ds_nama_sekolah}} | QL: {{$ps->quota_L_kaa}} | QP: {{$ps->quota_P_kaa}} | IL:{{$ps->JUM_LELAKI}}
                |IP:{{$ps->JUM_PEREMPUAN}} | KL:{{$ps->BEZA_L}} | KP:{{$ps->BEZA_P}} |</option>
            @endforeach

            @foreach ( $listsekolahpilihan_sabk_dini as $ps )
            <option value="DINI>{{$ps->kod_sekolah}}>{{$ps->ds_nama_sekolah}}">DINI>{{$ps->kod_sekolah}} >
                {{$ps->ds_nama_sekolah}} | QL: {{$ps->quota_L_sabk_dini}} | QP: {{$ps->quota_P_sabk_dini}} | IL:{{$ps->JUM_LELAKI}}
                |IP:{{$ps->JUM_PEREMPUAN}} | KL:{{$ps->BEZA_L}} | KP:{{$ps->BEZA_P}} |</option>
            @endforeach

            @foreach ( $listsekolahpilihan_sabk_tahfiz as $ps )
            <option value="TAHFIZ>{{$ps->kod_sekolah}}>{{$ps->ds_nama_sekolah}}">TAHFIZ>{{$ps->kod_sekolah}} >
                {{$ps->ds_nama_sekolah}} | QL: {{$ps->quota_L_sabk_tahfiz}} | QP: {{$ps->quota_P_sabk_tahfiz}} | IL:{{$ps->JUM_LELAKI}}
                |IP:{{$ps->JUM_PEREMPUAN}} | KL:{{$ps->BEZA_L}} | KP:{{$ps->BEZA_P}} |</option>
            @endforeach


        </select>

    </div>
<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable ">
                <thead>
                    <tr>
                        <th width="5">

                        </th>
                        <th width="5">
                            {{ trans('cruds.permission.fields.id') }}
                        </th>
                        <th width="5">
                            PENEMPATAN
                        </th>
                        <th width="5">
                            ALIRAN
                        </th>
                        <th>
                            NAMA CALON
                        </th>
                        <th>
                            SEKOLAH PILIHAN
                        </th>
                        <th>
                            PILIHAN
                        </th>
                        <th>
                            <div class="myDIV">GRED</i></div>
                            <div class="hide">
                                <div>BMF|BMT|BIF|BIT|MT|ST</div>
                            </div>
                        </th>
                        <th>
                        SEKOLAH <BR> SALURAN
                        </th>
                        <!--th>
                            &nbsp;
                        </th-->
                    </tr>
                </thead>
                <tbody>
                    @foreach($datamurids as $key => $datamurid)
                        <tr data-entry-id="{{ $datamurid->id }}">
                            <td>

                            </td>
                            <td>
                             <p>  <div class="badge badge text-wrap" style="width: 3rem;">{{ $datamurid->id ?? '' }} </p></td>
                            </td>
                            <td>
                                <div class="badge badge- text-wrap" style="width: 12rem;">  {{$datamurid->PENEMPATAN ??''}}</div>
                            </td>
                            <td>
                                <div class="badge badge- text-wrap" style="width: 12rem;">  {{$datamurid->ALIRAN_PENEMPATAN ??''}}</div>
                            </td>
                            <td>
                                <div class="badge badge- text-wrap" style="width: 12rem;" alignment="left">  {{ $datamurid->NAMA ?? '' }}</div>
                            </td>
                            <td> 
                                <div class="badge badge-primary text-wrap" style="width: 12rem;"> (KRK): {{ $datamurid->KRK_NAMA_SEK_DIPOHON?? '' }}</div><br> 
                                <div class="badge badge-warning text-wrap" style="width: 12rem;">(KAA): {{ $datamurid->KAA_NAMA_SEK_DIPOHON?? '' }}</div><br> 
                                    <div class="badge badge-success text-wrap" style="width: 12rem;">(SABK): {{ $datamurid->SABK_NAMA_SEK_DIPOHON?? '' }}</div><br> 
                            </td>
                            <td>
                                <div class="badge badge-primary text-wrap" style="width: 12rem;"> (P1): {{ $datamurid->PILIHAN_1?? '' }}</div><br>
                                    <div class="badge badge-warning text-wrap" style="width: 12rem;">(P2): {{ $datamurid->PILIHAN_2?? '' }}</div><br>
                                        <div class="badge badge-success text-wrap" style="width: 12rem;"> (P3): {{ $datamurid->PILIHAN_3?? '' }}</div>
                            </td>
                       
                            <td>
                                <div class="badge badge text-wrap" style="width: 12rem;"> {{ $datamurid->UPSR?? '' }}</div><br>

                                <div class="badge badge text-wrap" style="width: 12rem;">    
                                @php $stringA = ($datamurid->UPSR);
                                echo substr_count($stringA,"A").'A,';
                                $stringB = ($datamurid->UPSR );
                                echo substr_count($stringB,"B").'B,';
                                $stringC = ($datamurid->UPSR);
                                echo substr_count($stringC,"C").'C,';
                                $stringD = ($datamurid->UPSR);
                                echo substr_count($stringD,"D").'D,';
                                $stringE = ($datamurid->UPSR);
                                echo substr_count($stringE,"E").'E'; 
                            @endphp </div>
                                
                            </td>
                            <td>
                                <div class="badge badge-primary text-wrap" style="width: 12rem;">  {{ $datamurid->NAMA_SEKOLAH_MEN_LULUS?? '' }}</div>
                            </td>
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
@endsection

<style>
    .hide {
         display: none;
     }
 
     .myDIV:active+.hide {
         display: block;
         color: rgb(235, 85, 26);
     }
 </style>

@section('scripts')
@parent
<script>

function GetSelectedTextValue(ddlFruits) {
             
                var selectedValue = ddlFruits.value;
                alert(" NAMA SEKOLAH DIPILIH: " + selectedValue);
            }


    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = '{{ trans('global.datatables2.tempatkan_murid') }}'
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
        alert('{{ trans('global.datatables2.zero_selected') }}')
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    $test=pilih_sek_rendah;
})

</script>



@endsection