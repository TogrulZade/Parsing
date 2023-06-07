@extends('layout')

@section('content')
    @foreach($products as $pr)
    <div class="col-sm-3">
        <div class="box col-sm-12">
            <div class="image-container">
                <a href="/match/{{$pr->product->id}}">
                    <img src="{{str_contains($pr->product->image,'https://') ? $pr->product->image : 'https://bakuelectronics.az'.$pr->product->image}}" alt="">
                </a>
            </div>
            
            <div class="box-body">
                <div class="title">{{$pr->product->title}}</div>
                <div class="box-price">{{$pr->product->price}}</div>
                <br/><br/><br/>
                {{-- @foreach($pr->match as $match)
                    {{$match}}
                @endforeach --}}
            </div>
        </div>
    </div>

    
    @endforeach
@endsection