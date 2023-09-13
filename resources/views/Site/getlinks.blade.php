@extends('layout')

@section('content')


{{-- <div class="row"> --}}

    <div class="col-sm-9 bg-white p-3 rounded shadow">
        <div class="row">
            <div class="col-sm-6 mb-3 mt-3">
                <h3>{{$site->name}} saytının linkləri</h3>
            </div>
            
            <div class="col-sm-6 mb-3 mt-3">
                <a href="/site/addlink/{{$site->id}}" class="btn btn-sm btn-primary float-end">Link əlavə et</a>
            </div>
            
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <table class="table table-striped table-hover table-responsible">

                <thead>
                <th>#</th>
                <th>Məhsul linkləri</th>
                <th>Əməliyyat</th>
            </thead>
            @foreach ($data as $key=>$d)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$d->link}}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="/site/getdata/{{$d->id}}">Məhsul çək</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Düzenle</a></li>
                                <li><a class="dropdown-item" href="{{route("link.delete", ['id'=>$d->id])}}">Sil</a></li>
                            </ul>
                        </div>
                        {{-- <a href="/getdata/{$site->id}" class="btn btn-sm btn-primary">Run</a> --}}
                        {{-- <a href="/site/delete/{$site->id}" class="btn btn-sm btn-danger">Delete</a> --}}
                    </td>
                </tr>
                @endforeach
            @endsection
        </table>
    </div>
{{-- </div> --}}
