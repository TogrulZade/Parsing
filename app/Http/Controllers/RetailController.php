<?php

namespace App\Http\Controllers;

use App\Exports\RetailExport;
use Illuminate\Http\Request;
use App\Models\Retail;
use Maatwebsite\Excel\Facades\Excel;

class RetailController extends Controller
{
    public function show(Request $request)
    {
        $retails = Retail::all();
        return view("Retail/show", compact("retails"));
    }

    public function create(Request $request)
    {
        return view("Retail.create");
    }

    public function download()
    {
        return Excel::download(new RetailExport, 'retails.xlsx');
    }

    public function createAction(Request $request)
    {

        $name = $request->name;
        $url = $request->url;

        $check = Retail::where("name", "=", $name)
            ->orWhere("url", "=", $url)
            ->first();


        if ($check) {
            return redirect()->back()->withError(["error" => "Məlumant daha əvvəl bazaya əlavə edilib"]);
        }

        $save = new Retail();

        $save->name = $name;
        $save->url = $url;

        $save->save();

        return redirect(route("retails"))->with(["success" => "Retail əlavə edildi"]);
    }
}
