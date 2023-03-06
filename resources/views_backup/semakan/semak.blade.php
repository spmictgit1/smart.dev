@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">

            <div class="card p-4">

                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{URL::asset('/image/jata.jpg')}}" alt="profile Pic" height="20%" width="20%"
                            alignment="center" class="rounded-pill">
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active btn-primary " href="{{ url('semak') }}">Keputusan Penempatan
                                Murid</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">Log Masuk</a>
                        </li>
                    </ul>
                    <form action="{{ route('search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-12"> {{--KOLUMN 1--}}<br><br>
                                <div class="card card-primary">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5 class="text-muted">SEMAKAN PENEMPATAN MURID TINGKATAN 1 2022</h5>
                                            <p class="text-muted">Contoh No.KP Berjaya: 080102050272 <br> Tidak Berjaya:
                                                081120040312</p>
                                            <input type="text" class="form-control" name="nokp"
                                                placeholder="Masukkan No.KP" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Hantar</button>
                                <button type="reset" class="btn btn-warning">Set Semula</button>
                            </div>
                        </div>

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection