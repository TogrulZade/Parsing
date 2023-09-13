<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Requests\SiteRequest;

class SettingController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        return view("Setting/index", compact('sites'));
    }

    public function addsite()
    {
        return view("Setting/addsite");
    }

    public function addsiteAction(SiteRequest $request)
    {
        $validated = $request->validated();
        $name = $validated['name'];
        $domen = $validated['domen'];
        $link = $validated['link'];
        $iterable = $request->iterable;
        $title = $request->title;
        $title2 = $request->title2;
        $price = $request->price;
        $country = $request->country;
        $company = $request->company;
        $items_per_page = $request->items_per_page;

        $check = Site::where("name", "=", $name)->orWhere("domen", "=", $domen)->orWhere("link", "=", $link)->first();


        if ($check) {
            return redirect()->back()->withError(["error" => "Məlumant daha əvvəl bazaya əlavə edilib"]);
        }

        $save = new Site();

        $save->name = $name;
        $save->domen = $domen;
        $save->link = $link;
        $save->iterable = $iterable;
        $save->title = $title;
        $save->title2 = $title2;
        $save->price = $price;
        $save->company = $company;
        $save->country = $country;
        $save->items_per_page = $items_per_page;

        $save->save();

        return redirect("/settings/")->with(["success" => "Sayt əlavə edildi"]);
    }
}
