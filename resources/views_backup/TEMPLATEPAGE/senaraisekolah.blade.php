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
    <div class="widget-user-header bg-yellow">
        <h3 class="widget-user-username">TAJUK </h3>

        <!--marquee behavior="scroll" direction="left" scrolldelay="80">
            <h5> Selamat Datang {{ Auth::user()->name }} Semoga Aplikasi Ini Memberi Manfaat Kepada Kita Semua.</h5>
        </marquee-->
    </div>

</div>
<div class="card">
    <div class="card-header">
        Subtajuk
    </div>
    <div class="card-body">
        <!--MULA KANDUNGAN-->
       

        
        <!--TAMAT  KANDUNGAN-->
        <div class="row">
        </div>
    </div>
</div>
@endsection