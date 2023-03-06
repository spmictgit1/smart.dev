@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <!--div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.permissions.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}
        </a>
    </div-->
</div>
<div class="card">
    <div class="card-header bg-primary">
        <h6>SENARAI MURID DIPILIH DAN STATUS PENGESAHAN SEKOLAH</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th width="10">
                            BIL
                        </th>
			 <th>
                            STATUS
                        </th>
                        <th>
                            NOKP
                        </th>
                        <th>
                            NAMA
                        </th>
                        <th>
                            L/P
                        </th>
                        <th>
                            SEKOLAH
                        </th>
                        <th>
                            ALIRAN
                        </th>
			<th>
                           KATEGORI
                        </th>
			<th>
                          TEL.BAPA
                        </th>
			<th>
                          TEL.IBU
                        </th>

			<th>
			ALAMAT
			</th>
			<th>
			SEKOLAH RENDAH
			</th>                        
                       
                         @if (Auth::user()->kod_organisasi != 'jpnm')
                        <th>
                            
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($datamurids as $key => $dm)
                        <tr data-entry-id="{{ $dm->id }}">
                            <td>

                            </td>
                            <td>
                                {{  $key + $datamurids->firstItem()}}
                            </td>
 			    <td>
                                <div >
                                    @if ($dm->sahterima == '1')
                                    <span class="badge badge-success text-wrap" style="width: 4rem;">TERIMA
                                    </span>
                        
                                     @else
                                    <span class="badge badge-danger text-wrap" style="width: 4rem;">
                                    TOLAK                        
                                    </span>
                                    @endif</div>
                            </td>
                            <td>
                                {{ $dm->NOKP ?? '' }}
                            </td>
                            <td>
                                {{ $dm->NAMA?? '' }}
                            </td>
                            <td>
                                {{ $dm->KOD_JANTINA?? '' }}
                            </td>
                            <td>
                                {{ $dm->PENEMPATAN?? '' }}
                            </td>
                            <td>
                                {{ $dm->ALIRAN_PENEMPATAN?? '' }}
                            </td>
			    <td>
                                @if($dm->STATUS_R != 'R') BIASA 
				@else RAYUAN
				@endif
                            </td>
				 
                             <td>
                                {{ $dm->NO_TEL_BAPA?? '' }} 
                            </td>
			    <td>
			     	{{ $dm->NO_TEL_IBU?? '' }}
			    </td>
    			    <td>
                                {{ $dm->ALAMAT_MURID?? '' }}  {{ $dm->BANDAR?? '' }}  {{ $dm->POSKOD?? '' }}  {{ $dm->NEGERI?? '' }}
                            </td>
			    <td>
			 	 {{ $dm->NAMA_SEKOLAH?? '' }}
			   </td>
                           
                            @if (Auth::user()->kod_organisasi != 'jpnm')
                            <td>
                                <form action="{{ route('sahterimadelete.name', $dm->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="nokp" value="{{ $dm->NOKP ?? '' }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="BATAL">
                                </form>
                            </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'SAH TERIMA'
  let deleteButton = {
    text: deleteButtonTrans,
    //url: "{{ route('admin.permissions.mass_destroy') }}",
    url: "{{ route('sahterima.name') }}",
    className: 'btn-primary',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('SILA BUAT PILIHAN NAMA')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'POST' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 7, 'asc' ]],
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