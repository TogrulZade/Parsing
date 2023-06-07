@extends('layout')
@section('content')
    <h3>{{$domen}}</h3>
    <span>Scraping from: {{$link}}</span>
    <hr class="mt-3">
    @if(count($data) > 0)
    @foreach($data as $key => $item)
    
        <div class="col-sm-3 mb-3">
            <div class="product">
                <div class="product_image">
                    <img src="{{str_contains($item['image'], 'http') == false ? $base_url : null}}{{$item['image']}}" alt="{{$item['title']}}">
                </div>

                <div class="product_content">

                    <div class="product_title">
                        <a href="{{$item['url']}}">{{$item['title']}}</a>
                    </div>
                    
                    <div class="product_price">
                        <span style="margin-right: 10px">{{$item['price']}}</span>
                        @if($saved)
                            @if(in_array($item,$saved))
                                
                                <div class="ml-3 text-primary">
                                    Saved
                                    @php
                                        $x = in_array($item, $saved);
                                        print_r($item);
                                    @endphp
                                </div>
                            @endif
                        @endif
                    </div>

                </div>

            </div>
        </div>

        @endforeach
        <div class="row mt-3 mb-3">
            @if($page>1)
            <div class="col-sm-1">
                <a href="{{ substr($category,strlen($category)-1,1) == '/' ? substr($category,0,strlen($category)-1) : $category}}&page={{$page-1}}" class="btn btn btn-outline-primary">Əvvəlki</a>
            </div>
            @endif
            <div class="col-sm-1">
                <a href="?url={{ substr($category,strlen($category)-1,1) == '/' ? substr($category,0,strlen($category)-1) : $category}}&page={{$page+1}}" class="btn btn btn-outline-primary">Növbəti</a>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            Göstəriləcək məhsul tapılmadı
        </div>
        @if($page>1)
            <div class="row mt-3 mb-3">
                <div class="col-sm-1">
                    <a href="?url={{ substr($category,strlen($category)-1,1) == '/' ? substr($category,0,strlen($category)-1) : $category}}&page={{$page-1}}" class="btn btn btn-outline-primary">Əvvəlki</a>
                </div>
            </div>
        @endif

        <div class="col">
            <a href="/" class="btn btn-primary">Kategoriyalara qayıt</a>
        </div>
    @endif
@endsection