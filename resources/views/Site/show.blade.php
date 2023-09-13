@extends('layout')

@section('content')

<div class="col-sm-9">
<div class="row">

    <div class="col-sm-6 p-0 mb-3 mt-3">
        <h3>Məlumat çəkiləcək saytlar</h3>
    </div>

    <div class="col-sm-6 mb-3 mt-3">
        <a href="/settings/addsite/" class="btn btn-sm btn-primary float-end">Site əlavə et</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-sm-12 bg-white p-3 rounded shadow">

        <table class="table table-striped table-hover table-responsible">
                <thead>
                <th>#</th>
                <th>Site adı</th>
                <th>Domen</th>
                <th>Məhsul linkləri</th>
                <th>Əməliyyat</th>
            </thead>
            @foreach ($sites as $key=>$site)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$site->name}}</td>
                    <td>{{$site->domen}}</td>
                    <td>{{$site->link}}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="/site/{{$site->id}}/links/">Səhifələr</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/site/getdata/{{$site->id}}">Məhsul çək</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route("site.edit", ["id"=>$site->id])}}">Düzəliş</a></li>
                                <li><a class="dropdown-item" href="#">Sil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Məhsullar</a></li>
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
</div>
</div>
