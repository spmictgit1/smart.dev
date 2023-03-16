@extends('layouts.admin')

@section('content')



<div class="card-header bg-primary">
    <h6>MENGATUR SISTEM</h6>
</div>

<div class="w-full mt-8 bg-wh.ite rounded">

    <div class="card-header bg-primary">

            <h6 id="more" href="#"
                onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'TUTUP ATURAN':'TEKAN UNTUK UBAH ATURAN');});">
                MEMBUKA/MENUTUP
                ATURAN ESMART</h6>

        </div>
    <div class="details" style="display:none">
        <div class="card-header bg-primary">

            <form action="{{ route('statuses.store') }}" method="POST">
                @csrf
                <div>
                    <label class="switch switch-text switch-primary">
                        <input type="checkbox" class="switch-input" checked>
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
                <div>
                    <label class="nav-link active btn-success">
                        <input type="radio" name="status1" value="1"
                            {{$status->buka_tutup_rayuan == '1' ? 'checked' : ''}}>
                        <b>BUKA PERMOHONAN RAYUAN</b>
                    </label>
                </div>
                <div>
                    <label class="nav-link active btn-danger">
                        <input type="radio" name="status1" value="0"
                            {{$status->buka_tutup_rayuan == '0' ? 'checked' : ''}}>
                        <b>TUTUP PERMOHONAN RAYUAN</b>
                    </label>
                </div>

                <div>
                    <label class="nav-link active btn-success">
                        <input type="radio" name="status2" value="1"
                            {{$status->buka_tutup_semakan == '1' ? 'checked' : ''}}>
                        <b>BUKA SEMAKAN KEPUTUSAN</b>
                    </label>
                </div>
                <div>
                    <label class="nav-link active btn-danger">
                        <input type="radio" name="status2" value="0"
                            {{$status->buka_tutup_semakan == '0' ? 'checked' : ''}}>
                        <b>TUTUP SEMAKAN KEPUTUSAN</b>
                    </label>
                </div>
                <button type="submit">SIMPAN</button>
                <div>
                    <div>
                        <form action="{{url('jana.url')}}" method="POST">



                            <table class="table table-responsive-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">JANA MARKAH MERIT</th>
                                        <th class="text-center">JANA KOD PPD</th>
                                        <th class="text-center"> JANA SEKOLAH RAYUAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <div class="mt-6">
                                                <button class="btn btn-warning" type="submit">
                                                    JANA
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="button">
                                                <a class="btn btn-success" href="{{ url('janakodppd.url') }}">
                                                    JANA 
                                                    {{-- trans('global.add') }}
                                                    {{ trans('cruds.user.title_singular') --}}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="button">
                                                <a class="btn btn-success" href="{{ url('janarayuan.url') }}">
                                                    JANA
                                                    {{-- trans('global.add') }}
                                                    {{ trans('cruds.user.title_singular') --}}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                        </form>
                        <div class="card-header bg-primary">
                                <h6>MUAT NAIK DATA MURID</h6>
                            </div>
                            <form action="/upload-csv" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file">
                                <button type="submit">Muat Naik CSV</button>
                            </form>
                    </div>
                </div>
        </div>
    </div>
</div>

<br><br>

<div>
    <br />
    <!--Halaman : {{-- $datamurids->currentPage() --}} <br />  -->
    <b> JUMLAH DATA : {{ $datamurids->total() }} <br>
        DATA PERHALAMAN : {{ $datamurids->perPage() }} </b><br />
    {{ $datamurids->links( "pagination::bootstrap-4") }}

</div>

<div class="card">
    <table class="table table-bordered table-striped table-hover datatable datatable-Permission">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAMA</th>
                <th scope="col">NOKP</th>
                <th scope="col">MERIT</th>
                <th scope="col">KOD PPD SP1</th>
                <th scope="col">KOD PPD SP2</th>
                <th scope="col">KOD PPD SP3</th>
                <th scope="col">KOD SEK RAYU 1</th>
                <th scope="col">KOD SEK RAYU 2</th>
                <th scope="col">NAMA SEK RAYU 1</th>
                <th scope="col">NAMA SEK RAYU 2</th>


            </tr>
        </thead>
        <tbody>
            <tr>@foreach ($datamurids as $key =>$dm)
                @csrf
                <th scope="row">{{  $key + $datamurids->firstItem()}}</th>
                <th>{{ $dm->NAMA }} </th>
                <th>{{ $dm->NOKP }}</th>
                <!--th>{{-- $dm->point }}
                            <input type="hidden" id="pt[{{$dm->id}}]" name="pt[{{$dm->id}}]" class="form-control"
                            value="{{number_format($dm->jumlah,1)--}}"
                            {{--$dm->sekolah_jantina_L == '' ? 'readonly' : ''--}}>               
                        </th-->
                <th>{{number_format($dm->point,2)}}</th>
                <th>{{ $dm->PPD_SP1 }}</th>
                <th>{{ $dm->PPD_SP2 }}</th>
                <th>{{ $dm->PPD_SP3 }}</th>
                <th>{{ $dm->KOD_SR1 }}</th>
                <th>{{ $dm->KOD_SR2 }}</th>
                <th>{{ $dm->NAMA_SR1 }}</th>
                <th>{{ $dm->NAMA_SR2 }}</th>
            </tr>@endforeach

        </tbody>
    </table>

</div>
<div>
    <br />
    <!--Halaman : {{-- $datamurids->currentPage() --}} <br />  -->
    Jumlah Data : {{ $datamurids->total() }} <br />
    Data Per Halaman : {{ $datamurids->perPage() }} <br />
    {{ $datamurids->links( "pagination::bootstrap-4") }}
</div>
</div>

</div>

</div>

</form>

</div>
</div>
</div>
@endsection
