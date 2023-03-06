@extends('layouts.admin')
@section('content')
@can('users_manage')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        SENARAI SEKOLAH   
    </div>
<div><form action="{{route('aliran.simpan')}}" method="POST">

    <div class="mt-6">
        <button
            class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text font-bold py-2 px-4 rounded"
            type="submit">
            Simpan Perubahan
        </button>
    </div></div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th width="10">
                            BIL
                        </th>
                        <th >
                            PPD
                        </th>
                        <th width="10">
                            KOD
                        </th>
                        <th>
                            NAMA SEKOLAH
                        </th>
                        <th>
                            JENIS SEK
                        </th>
                        <th>
                            JANTINA
                        </th>
                        <th>
                            KAA
                        </th>
                        <th>
                            SABK
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datasekolah as $key => $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td width="10">
                                {{ $data->id ?? '' }}
                            </td>
                            <td>
                                {{ $data->ppd ?? '' }}
                            </td>
                            <td>
                                {{ $data->kod_sekolah ?? '' }}
                            </td>
                            <td>
                                {{ $data->nama_sekolah ?? '' }}
                            </td>
                            <td>
                                {{ $data->JenisSekolah ?? '' }}
                            </td>
                            <td>
                                {{ $data->sekolah_jantina_L ?? '' }}{{ $data->sekolah_jantina_P ?? '' }}
                            </td>
                            <td>
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            
                                    <input type="hidden" name="sekolah_kaa[{{$data->id}}]" value="0">
                                    <input  name="sekolah_kaa[{{$data->id}}]" class="leading-tight" type="checkbox" value="KAA" {{$data->sekolah_kaa == 'KAA' ? 'checked' : ''}}>
                                    <span class="text-sm">KAA</span>
                                </label>
                            </td>
                            <td>
                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input type="hidden" name="sekolah_sabk_dini[{{$data->id}}]" value="0">
                                    <input name="sekolah_sabk_dini[{{$data->id}}]" class="leading-tight" type="checkbox" value="DINI" {{$data->sekolah_sabk_dini == 'DINI' ? 'checked' : ''}}>
                                    <span class="text-sm">DINI</span>
                                </label>  
                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input type="hidden" name="sekolah_sabk_tahfiz[{{$data->id}}]" value="0">
                                    <input name="sekolah_sabk_tahfiz[{{$data->id}}]" class="leading-tight" type="checkbox" value="TAHFIZ" {{$data->sekolah_sabk_tahfiz == 'TAHFIZ' ? 'checked' : ''}}>
                                    <span class="text-sm">TAHFIZ</span>
                                </label>   
                            </td>

                           
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
@can('users_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.mass_destroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection