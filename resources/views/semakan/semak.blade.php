@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">

            <div class="card p-4">

                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{URL::asset('/image/xjata.jpg')}}" alt="profile Pic" height="20%" width="20%"
                            alignment="center" class="rounded-pill">
                           
                    </div>
                    <div class="row justify-content-center">
                    <h1>e-SMART</h1>
                    </div>
                    <div class="row justify-content-center">
                        <h5>e-Semakan Ambilan & Rayuan Tingkatan 1 (KAA&SABK) </h5>
                        </div>
                        <div class="row justify-content-center">
                        <h6>Jabatan Pendidikan Negeri Melaka</h6>
                        </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active btn-success " href="{{ url('semak') }}"><b>SEMAKAN KEPUTUSAN PENEMPATAN MURID</b></a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link active btn-primary" href="{{url('/')}}"><b>LOG MASUK ADMIN/PEGAWAI<b></a>
                        </li>
                    </ul>
                    @if($status->buka_tutup_semakan== '1')
                    
                    <form action="{{ route('search') }}" method="post">
			 {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12"> {{--KOLUMN 1--}}<br><br>
                                <div class="card card-primary">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5 class="text-muted">SEMAKAN PENEMPATAN MURID TINGKATAN 1 2023</h5>
                                            
                                            <input type="text" class="form-control" name="nokp"
                                                placeholder="Masukkan No.KP" required>
                                        </div>
                                        <i class="text-danger">{{session('error');}}</i>
                                    </div>
                                    
                                </div>

                                <button type="submit" class="btn btn-success">Hantar</button>
                                <button type="reset" class="btn btn-warning">Set Semula</button>
                            </div>
                        </div>

                </div>
            </div>
            </form>
                    @else
                    <a class="nav-link active btn-danger"><b>HARAP MAAF, SEMAKAN KEPUTUSAN BELUM DIBUKA<b></a>
                    
                    @endif
                   


 <!--form method="post" action="{{ route('search') }}">
                            {{ csrf_field() }}
                            <h1>{{-- env('APP_NAME', 'Permissions Manager') --}}</h1>
                            <p class="text-muted">Login</p>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input name="nokp" type="text"
                                    class="form-control" required
                                    autofocus placeholder="No.KP" value="{{old('nokp', null) }}">
                    
                            </div>

                           
                            <div class="input-group mb-4">
                                <div class="form-check checkbox">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember"
                                        style="vertical-align: middle;"/>
                                    <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4">
                                        Login
                                    </button>
                                </div>
                                <div class="col-6 text-right">
                                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                        Forgot your password?
                                    </a>

                                </div>
                            </div>
                        </form-->



        </div>
    </div>
</div>
</div>
</div>
@endsection
