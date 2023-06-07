@extends('layout')

@section('content')
    @foreach($products as $pr)
    <div class="col-sm-3">
        <div class="box col-sm-12" style="padding: 25px 15px; border-radius: 6px; background-color: #fff; height: 360px">
            <img src="{{str_contains($pr->product->image,'https://') ? $pr->product->image : 'https://bakuelectronics.az'.$pr->product->image}}" style="width: 100%;" alt="">
            <div class="col-sm-12">
                <a href="#" class="btn btn-outline-primary col-12">Əlavə et</a>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <h3>{{$pr->product->title}}</h3>
        <div class="col-sm-12">
            <div class="item-container">
                <div class="site me-3">{{$pr->product->domen}}</div>
                <div class="title me-3">{{$pr->product->title}}</div>
                <div class="price-container ms-auto">
                    <div class="price">{{$pr->product->price}} AZN</div>
                    <a href="{{$pr->product->link}}" target="_blank" class="btn btn-primary col-12">Sayta keç</a>
                </div>
            </div>

            <div class="item-container">
                <div class="site me-3">{{$pr->matchedProduct->domen}}</div>
                <div class="title me-3">{{$pr->matchedProduct->title}}</div>
                <div class="price-container ms-auto">
                    <div class="price">{{$pr->matchedProduct->price}} AZN</div>
                    <a href="{{$pr->matchedProduct->link}}" target="_blank" class="btn btn-primary col-12">Sayta keç</a>
                </div>
            </div>
        </div>

        
    </div>
    @endforeach
@endsection