@extends('layout')

@section('content')
    <div class="col-sm-2">
        <div class="list-group">
            <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                Websites
            </button>
            <button type="button" class="list-group-item list-group-item-action">Məlumat</button>
            <button type="button" class="list-group-item list-group-item-action">A third button item</button>
            <button type="button" class="list-group-item list-group-item-action">A fourth button item</button>
            <button type="button" class="list-group-item list-group-item-action" disabled>A disabled button item</button>
            </div>
    </div>

    <div class="col-sm-10">
        <div class="bg-white p-3 rounded-3 shadow-sm">
            <table id="myTable" class="table table-striped" style="width: 100%">
                <thead>

                <tr>
                    <th>#</th>
                    <th>Domen</th>
                    <th>Tarix</th>
                </tr>
                </thead>
                <tr>
                    <td>1</td>
                    <td>togrul.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>google.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>togrul.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>facebook.az</td>
                    <td>01.06.2023</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>google.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>hesab.az</td>
                    <td>01.06.2023</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>aptekonline.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>kanon.az</td>
                    <td>01.06.2023</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>aptekonline.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>kanon.az</td>
                    <td>01.06.2023</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>aptekonline.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a class="link" href="#">kanon.az</a></td>
                    <td>01.06.2023</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>aptekonline.az</td>
                    <td>01.06.2023</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a class="link" href="#">kanon.az</a></td>
                    <td>01.06.2023</td>
                </tr>

            </table>
        </div>
    </div>
@endsection