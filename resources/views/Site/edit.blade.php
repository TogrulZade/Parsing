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
    <div class="col-sm bg-white m-3 p-3 shadow-sm">

        <a href="{{back()->getTargetUrl()}}" class="btn btn-sm btn-outline-primary">Geri</a>
    </div>
    <form action="{{route("site.edit.action",['id'=>$site->id])}}" method="post">
        @csrf
        <div class="col-sm-12 mb-5">
            <div class="p-3 bg-white rounded shadow-sm">

                <h4><span class="text-danger">{{$site->name}}</span> | Düzəliş et</h4>
                <hr>

                <div class="form-group mb-3">
                    <label for="name" class="mb-2">Site name</label>
                    <input type="text" name="name" id="name" value="{{$site->name}}" placeholder="Site name" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="domen" class="mb-2">Domen</label>
                    <input type="text" name="domen" id="url" value="{{$site->domen}}" placeholder="https://aptekonline.az/" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="link" class="mb-2">Məhsulların linki</label>
                    <input type="text" name="link" id="link" value="{{$site->link}}" placeholder="https://aptekonline.az/products/" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="has_retail" class="mb-2">Saytda fərqli retaillər var?</label>
                    <select class="form-control" name="has_retail" id="has_retail">
                        <option value="0" {{$site->has_retail ? 'selected':null}}>Xeyr</option>
                        <option value="1" {{$site->has_retail ? 'selected':null}}>Bəli</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="iterable" class="mb-2">Təkrarlanan class</label>
                    <input type="text" name="iterable" value="{{$site->iterable}}" id="iterable" placeholder="products" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="title" class="mb-2">Title class</label>
                    <input type="text" name="title" value="{{$site->title}}" id="title" placeholder="Latin və ya Rus əlifbası üçün" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="title2" class="mb-2">Title2 class</label>
                    <input type="text" name="title2" value="{{$site->title2}}" id="title2" placeholder="Latın və ya Rus əlifbası üçün" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="price" class="mb-2">Qiymət class</label>
                    <input type="text" name="price" value="{{$site->price}}" id="price" placeholder="Qiymətin saxlandığı class adı" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="company" class="mb-2">Şirkət class</label>
                    <input type="text" name="company" value="{{$site->company}}" id="company" placeholder="Məhsulun hansı şirkətə aid olduğu class-ın adı" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="country" class="mb-2">Ölkə class</label>
                    <input type="text" name="countyr" value="{{$site->country}}" id="countyr" placeholder="Məhsulun hansı ölkəyə aid olduğu class-ın adı" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="items_per_page" class="mb-2">Bir səhifədəki məhsul sayı</label>
                    <input type="number" min="0" step="1" name="items_per_page" value="{{$site->items_per_page}}" id="items_per_page" placeholder="Məhsullar səhifəsində neçə məhsul sıralanır?" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="pagination" class="mb-2">Səhifələmə</label>
                    <input type="number" min="0" step="1" name="pagination" value="{{$site->pagination}}" id="pagination" placeholder="Saytda səhifələmə necə gedir?" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Düzəliş et</button>
                </div>

            </div>
        </div>
    </form>
</div>
</div>

@endsection