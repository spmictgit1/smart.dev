@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">

            <div class="card p-4">
                <!--div style="border: 0px solid rgb(12, 8, 235);"></div-->
                <div class="card-body">
                    
                    <div class="row justify-content-center">
                        <img src="{{URL::asset('/image/xjata.jpg')}}" alt="profile Pic" height="20%" width="20%"
                            alignment="center" class="rounded-pill">

                             
                    </div>
                    <div class="row justify-content-center">
                    <h1>e-SMART</h1>
                    </div>
                    
                    <div class="row justify-content-center">
                    <h5>e-Semakan Ambilan & Rayuan Tingkatan 1 (KAA&SABK) Tahun 2023/2024</h5>
                    </div>
                    <div class="row justify-content-center">
                    <h6>Jabatan Pendidikan Negeri Melaka</h6>
                    </div>

                  

                    <ul class="nav nav-tabs">
                
                        <li class="nav-item">
                        <a class="nav-link active btn-success" href="{{ url('semak')}}"><b>SEMAKAN KEPUTUSAN PENEMPATAN MURID</b></a>
                        </li> 
                
                        <li class="nav-item">
                            <a class="nav-link active btn-primary" href="{{--route('murid_isi.name')--}}"><b>LOG MASUK ADMIN/PEGAWAI<b></a>
                        </li>
                    </ul>

                    <div class="card-body">
                        @if(\Session::has('message'))
                        <p class="alert alert-info">
                            {{ \Session::get('message') }}
                        </p>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <h1>{{-- env('APP_NAME', 'eSMART') --}}</h1>
                            <p class="text-muted">Login</p>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input name="email" type="text"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                                    autofocus placeholder="Email" value="{{ old('email', null) }}">
                                @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input name="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                                    placeholder="Password">
                                @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                            </div>

                            <div class="input-group mb-4">
                                <div class="form-check checkbox">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember"
                                        style="vertical-align: middle;"/>
                                    <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                        Remember me ....
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
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
