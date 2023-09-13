@extends('layout')

@section('content')

<div class="col-sm-9">
    
    @error("name")
            <div class="col-sm-12">
                <div class="alert alert-danger">{{$message}}</div>
            </div>
    @enderror

    @error("link")
        <div class="col-sm-12">
            <div class="alert alert-danger">{{$message}}</div>
        </div>
    @enderror

    <div class="row">
        <form action="{{route("retail.create")}}" method="post">
            @csrf
            <div class="col-sm-12 mb-5">
                <div class="p-3 bg-white rounded shadow-sm">
                    <div class="form-group mb-3">
                        <label for="name" class="mb-2">Retail name</label>
                        <input type="text" name="name" id="name" placeholder="Site name" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="url" class="mb-2">Web ünvan</label>
                        <input type="text" name="url" id="url" placeholder="https://aptekonline.az/" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Əlavə et</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection