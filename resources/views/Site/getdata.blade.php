@extends('layout')

@section('content')
<div class="col-sm-10 bg-white rounded shadow-sm">
    <div class="col-sm-12 p-2">
        <a href="{{route("sites")}}" class="btn btn-sm btn-primary">Saytlar</a>
        <hr>
        <a href="?page={{request('page')+1}}" class="btn btn-sm btn-primary">Növbəti ({{gettype(request('page'))}})</a>
    </div>
    <table class="table table-striped table-responsible table-hover">
        <thead>
            <th>#</th>
            <th>Title</th>
            <th>Qiymət</th>
            <th>Ölkə</th>
            <th>Şirkət</th>
        </thead>
        @foreach ($data as $key=>$dt)
            <tr>
                <td>{{$key}}</td>
                <td>{{$dt['title']}}</td>
                <td>{{$dt['price']}}</td>
                <td>
                    @isset($dt['country'])
                        {{ $dt['country'] }}
                    @endisset
                </td>
                <td>
                    @isset($dt['company'])
                        {{$dt['company']}}
                    @endisset
                </td>
                {{-- <td>
                    <div class="dropdown">
                        <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Məhsul çək</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Düzenle</a></li>
                            <li><a class="dropdown-item" href="#">Sil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Məhsullar</a></li>
                        </ul>
                    </div>

                </td> --}}
            </tr>
            @endforeach
    </table>
</div>
@endsection