<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME', 'Permissions Manager') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <div class="card">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active btn-primary" href="{{ url('semak') }}">Keputusan Penempatan Murid</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{url('/')}}">Log Masuk</a>
            </li>
        </ul>
        <div>
            <div class="card-body">
                <div class="table-responsive">
                    @if($datamurid->PENEMPATAN != '')

                    <div align='center'>
                        <div class="card-header bg-success">
                            <h3><b>TAHNIAH. PERMOHONAN ANDA BERJAYA</b>.</h3>
                        </div>
                    </div>

                    <table class='table table-bordered table-striped'>

                        <thead>
                        <tfoot></tfoot>
                        <tr>
                            <td>Nama Murid: </td>
                            <th>{{ $datamurid->NAMA ?? '' }}</th>

                        </tr>
                        <tr>
                            <td>No. Kad Pengenalan:</td>
                            <th>{{ $datamurid->NOKP ?? '' }}</th>

                        </tr>
                        <tr>
                            <td>Sekolah ditawarkan :</td>
                            <th>{{ $datamurid->PENEMPATAN?? '' }}</th>
                        </tr>

                        <tr>
                            <td>Aliran ditawarkan :</td>
                            <th>{{ $datamurid->ALIRAN_PENEMPATAN?? '' }}</th>
                        </tr>
                        <tr>
                            <td>No Tel Sekolah :</td>
                            <th>@foreach ($notel_sek as $notel )
                                0{{$notel->no_telefon_sekolah}}
                                @endforeach</th>
                        </tr>
                        <tr>
                            <td>Tarikh Lapor Diri/ Pengesahan:</td>
                            <th>4 JANUARI 2021 HINGGA 20 JANUARI 2021</th>
                        </tr>
                        <tr>
                            <td>Penginapan Asrama:</td>
                            <th>TERTAKLUK KEPADA KEKOSONGAN/PERTIMBANGAN PIHAK SEKOLAH</th>
                        </tr>
                        </tbody>
                    </table>
                    <tr>
                        <a class="btn btn-success"
                            href="{{ url('surat_tawaran-pdf',[$datamurid->NOKP,$datamurid->NAMA,$datamurid->PENEMPATAN,$datamurid->ALIRAN_PENEMPATAN,$notel->no_telefon_sekolah] ) }}">
                            CETAK SURAT TAWARAN
                        </a>
                    </tr>
                    </tbody>

                    </table>
                    @elseif ($datamurid->PENEMPATAN == '')
                    <div align='center'>
                        <div class="card-header bg-warning">
                            <h4><b>DUKACITA DIMAKLUMKAN , PERMOHONAN ANDA TIDAK BERJAYA</b></h4>
                        </div>
                    </div>
                    <table class='table table-bordered table-striped'>
                        <thead>
                        <tfoot></tfoot>
                        <tr>
                            <td>Nama Murid: </td>
                            <th>{{ $datamurid->NAMA ?? '' }}</th>
                            </thead>

                            <thead>
                            <tfoot></tfoot>
                        <tr>
                            <td>No KP / My Kid: </td>
                            <th>{{ $datamurid->NOKP ?? '' }}</th>
                            </thead>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>