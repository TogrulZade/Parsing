@extends('layout')

@section('content')

<form action="automation" method="POST">
    @csrf
    
    <div class="col-sm-3 mb-3">
        <label for="site" class="form-label">Site:</label>
        <input type="text"
            class="form-control" name="site" placeholder="https://kontakt.az/category/subcategory/">
    </div>

    <div class="col-sm-3 mb-3">
        <label for="iterated" class="form-label">Iterated class</label>
        <input type="text"
            class="form-control" name="iterated" placeholder="products without . (dot)">
    </div>

    <div class="col-sm-3 mb-3">
        <label for="name" class="form-label">Title class</label>
        <input type="text"
            class="form-control" name="name" placeholder="title class">
    </div>

    <div class="col-sm-3 mb-3">
        <label for="price" class="form-label">Price class</label>
        <input type="text"
            class="form-control" name="price" placeholder="price class">
    </div>

    <div class="col-sm-3 mb-3">
        <label for="image" class="form-label">Image class</label>
        <input type="text"
            class="form-control" name="image" placeholder="image class">
    </div>

    <div class="col-sm-3 mb-3">
        <label for="link" class="form-label">Product link class</label>
        <input type="text"
            class="form-control" name="link" placeholder="link class">
    </div>

    <div class="col-sm-3 mb-3">
        <button type="submit" class="btn btn-primary">Parse</button>
    </div>


</form>        
@endsection