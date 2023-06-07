@extends('layout')

@section('content')

<form action="/getFrom" method="POST">
    @csrf
    <div class="col-sm-6 mb-3">
        <label for="" class="form-label">Saytın ünvanını yerləşdir</label>
        <input type="text"
        class="form-control" name="link" id="" aria-describedby="helpId" placeholder="https://www.example.com/categoryName/products/">
    </div>
    
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary">Parse</button>
    </div>

</form>
    @endsection