@extends('layout')

@section('content')
<div class="row">
    <ol>
        @foreach($data as $key=>$dt)
            <h3>{{$dt['section']}}</h3>
            @foreach($dt['item'] as $item)
            <li class="mb-2">
                <a href="/bakuelectronics/{{$item['title']}}">{{$item['title']}}</a>
                <span><a href="/bakuelectronics/?url={{$item['url']}}" class='btn btn-sm btn-primary'> Parsing </a></span>
                {{-- <span>{{$item['url']}}</span> --}}
            </li>
        @endforeach
        @endforeach
    </ol>
</div>
@endsection