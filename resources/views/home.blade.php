{{--@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            Home
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
--}}

@extends('layouts.admin')
@section('content')

<div class="box box-widget widget-user-2">
  <div class="widget-user-header bg-primary">
    <h6 class="widget-user-username">DASHBOARD </h6>

    <marquee behavior="scroll" direction="left" scrolldelay="80">
      <h5> Selamat Datang {{ Auth::user()->name }} Semoga Aplikasi Ini Memberi Manfaat Kepada Kita Semua.</h5>
    </marquee>
  </div>

</div>

<div class="card">



  

  <div class="card-body">

    @role('pegawai_jpnm_view|admin_jpn')
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-facebook content-center">
            <i class="far fa-user-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
           
              <div class="text-value">JUMLAH CALON<br>@foreach ($kira_dashboard as $kd )
               
                {{$kd->jum_calon}}
                
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>

          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-behance content-center">
            <i class="far fa-check-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">CALON BERJAYA<br>@foreach ($kira_dashboard as $kd )
                {{$kd->berjaya}}
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>


          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-dribbble content-center">
            <i class="far fa-file-excel icon text-white my-4 display-4 "></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value"> BELUM BERJAYA<br>@foreach ($kira_dashboard as $kd )
                {{$kd->gagal}}
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>

          </div>
        </div>
      </div>
     
    </div>
    @endrole

    @role('ppd')
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-facebook content-center">
            <i class="far fa-user-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
           
              <div class="text-value">JUMLAH CALON BERJAYA<br>@foreach ($kira_dashboard_ppd_baru as $kd )
               
                {{$kd->PPD_BERJAYA}}
                
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>

          </div>
        </div>
      </div>
      <!--div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-behance content-center">
            <i class="far fa-check-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">CALON BERJAYA<br>@foreach ($kira_dashboard as $kd )
                {{$kd->berjaya}}
              @endforeach</div>
              <div class="text-uppercase text">friends</div>
            </div-->


          </div>
        </div>
      </div>
      <!--div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-dribbble content-center">
            <i class="far fa-file-excel icon text-white my-4 display-4 "></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">CALON TIDAK BERJAYA<br>@foreach ($kira_dashboard as $kd )
                {{$kd->gagal}}
              @endforeach</div>
              <div class="text-uppercase text">friends</div>
            </div-->

          </div>
        </div>
      </div>
     
    </div>
    @endrole

    @role('admin_sekolah')
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-facebook content-center">
            <i class="far fa-check-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
           
              <div class="text-value">BERJAYA<br>@foreach ($kira_dashboard_sekolah as $kd )
               
                {{$kd->berjaya}}
                
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>

          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-behance content-center">
            <i class="far fa-user-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">LELAKI<br>@foreach ($kira_dashboard_sekolah as $kd )
                {{$kd->Lelaki}}
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>


          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-dribbble content-center">
            <i class="far fa-user-circle icon text-white my-4 display-4 "></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">PEREMPUAN<br>@foreach ($kira_dashboard_sekolah as $kd )
                {{$kd->Perempuan}}
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>

          </div>
        </div>
      </div>
     
    </div>

    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-facebook content-center">
            <i class="far fa-check-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
           
              <div class="text-value">TERIMA<br>@foreach ($kira_terima_tolak as $kd )
               
                {{$kd->TERIMA}}
                
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>

          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card" style="max-width: 18rem;">
          <div class="card-header bg-behance content-center">
            <i class="far fa-user-circle icon text-white my-4 display-4"></i>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="text-value">TOLAK<br>@foreach ($kira_terima_tolak as $kd )
                {{$kd->TOLAK}}
              @endforeach</div>
              <!--div class="text-uppercase text">friends</div-->
            </div>


          </div>
        </div>
      </div>
      
     
    </div>
    @endrole
    {{-- <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                   xx
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
    {{ trans('global.back_to_list') }}
    </a>
  </div>
  --}}
  <nav class="mb-3">
    <div class="nav nav-tabs">

    </div>
  </nav>
  <div class="tab-content">

  </div>
</div>
</div>

{{--
<div class="card">
    <div class="card-header">
       Utama
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                   xx
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
{{ trans('global.back_to_list') }}
</a>
</div>

<nav class="mb-3">
  <div class="nav nav-tabs">

  </div>
</nav>
<div class="tab-content">

</div>
</div>
</div>

--}}
@endsection