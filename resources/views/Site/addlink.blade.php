@extends('layout')

@section('content')



@error("link")
    <div class="col-sm-12">
        <div class="alert alert-danger">{{$message}}</div>
    </div>
@enderror

<div class="col-sm-9">
    <div class="col-sm mb-2">

        <a href="{{back()->getTargetUrl()}}" class="btn btn-sm btn-outline-primary">Geri</a>
    </div>
    <h3 class="mb-3"><span class="badge bg-success">{{$site->name}}</span> saytından çəkiləcək yeni səhifə (kateqoriya) əlavə et</h3>
    <form action="{{route("addlinkAction", ['id'=>$site->id])}}" method="post">
        @csrf
        <div class="col-sm-12 mb-5">
            <div class="p-3 bg-white rounded shadow-sm">
                
                @error("error")
                        <div class="alert alert-danger">{{$message}}</div>
                @enderror
                
                <div class="form-group mb-3">
                    <label for="link" class="mb-2">Səhifə</label>
                    <input type="text" name="link" id="link" placeholder="https://aptekonline.az/products/" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Əlavə et</button>
                </div>

            </div>
        </div>
    </form>
</div>

@endsection