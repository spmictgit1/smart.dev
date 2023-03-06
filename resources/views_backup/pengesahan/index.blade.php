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
    <div class="card-header">
       <B> SENARAI NAMA MURID</B>
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
                            NOKP
                        </th>
                        <th>
                            NAMA
                        </th>
                        <th>
                            JANTINA
                        </th>
                        <th>
                            SEKOLAH
                        </th>
                        <th>
                            ALIRAN
                        </th>
                        <th>
                            STATUS
                        </th>
                        <th>
                            
                        </th>
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
                                <form action="{{ route('sahterimadelete.name', $dm->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="nokp" value="{{ $dm->NOKP ?? '' }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="BATAL">
                                </form>
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection