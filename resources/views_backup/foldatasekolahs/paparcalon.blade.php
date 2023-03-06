@extends('layouts.admin')

@section('content')


<div class="w-full mt-8 bg-wh.ite rounded">
    <div class="card" >

    <form action="{{url('jana.url')}}" method="POST">

        <div class="mt-6">
            <button
                class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text font-bold py-2 px-4 rounded"
                type="submit">
                JANA MARKAH
            </button>
        </div>
        <div>
            <br />
            Halaman : {{ $datamurids->currentPage() }} <br />
            Jumlah Data : {{ $datamurids->total() }} <br />
            Data Per Halaman : {{ $datamurids->perPage() }} <br />
            {{ $datamurids->links( "pagination::bootstrap-4") }}
        </div>
        <div class="card">
            <table class="table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">NOKP</th>
                        <th scope="col">POINT</th>
                       

                    </tr>
                </thead>
                <tbody>
                    <tr>@foreach ($datamurids as $key =>$dm)
                        @csrf
                        <th scope="row">{{  $key + $datamurids->firstItem()}}</th>
                        <th>{{ $dm->NAMA }} </th>
                        <th>{{ $dm->NOKP }}</th>
                        <th>{{ $dm->point }}
                            <input type="hidden" id="pt[{{$dm->id}}]" name="pt[{{$dm->id}}]" class="form-control"
                            value="{{number_format($dm->jumlah,1)}}"
                            {{--$dm->sekolah_jantina_L == '' ? 'readonly' : ''--}}>
                
                        </th>

                         
                    </tr>@endforeach

                </tbody>
            </table>

        </div>
</div>

</div>

</div>

</form>

</div>
</div>
</div>
@endsection