<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use \simplehtmldom\HtmlDocument;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

use App\Models\Site;
use App\Models\Derman;
use App\Models\Link;
use App\Models\Tafsir;

class SiteController extends Controller
{
    // public function getdata(Request $request)
    // {
    //     return view("Site/getdata");
    // }

    public function show(Request $request)
    {
        $sites = Site::all();
        return view("Site.show", compact("sites"));
    }

    public function getdata(Request $r)
    {
        $id = $r->id;
        $page = isset($r->page) ? (!empty($r->page) ? "hoha" : "bibib") : 1;

        $site = Site::find($id);
        if ($site == null) {
            return redirect()->back()->withErrors(["error" => "Bazada parse ediləcək sayt tapılmadı"]);
        }

        $iterated = $site->iterable;
        $title = $site->title;
        $price = $site->price;
        $item_link = $site->item_link;
        $cc = $site->company;

        $base_url = 'https://' . explode('/', str_replace('https://', '', $r->site))[0];

        $data = [];

        $count = 0;
        // for ($k = 1; $k <= 1; $k++) {

        $client = new Client();
        $crawler = $client->request('GET', $site->link . "?page=" . $page);

        $crawler->filter($iterated)->each(function (Crawler $node, $i) use (&$data, &$site, &$iterated, &$title, &$price, &$item_link, &$cc, &$k, &$count) {
            $count++;

            if ($node->filter($title)->count() > 0) {
                $data[$count]['title'] = $node->filter($title)->text();
                $data[$count]['url'] = $node->filter($item_link)->attr('href');
            }

            if ($node->filter($price)->count() > 0) {
                $data[$count]['price'] = str_replace("AZN", "", $node->filter($price)->text());
                $data[$count]['price'] = str_replace("₼", "", $node->filter($price)->text());
                $data[$count]['price'] = str_replace(" ₼", "", $node->filter($price)->text());
                $data[$count]['price'] = str_replace(",", ".", $node->filter($price)->text());
                $data[$count]['price'] = explode(" ", $node->filter($price)->text())[0];
            } else {
                $data[$count]['price'] = 0;
            }
            if (!is_null($cc)) {
                if ($node->filter($cc)->count() > 0) {
                    $c = $node->filter($cc)->text();
                    $c = str_replace("i̇", "i", $c);
                    $country = ucfirst(mb_strtolower(trim(explode("|", $c)[0])));
                    $company = ucfirst(mb_strtolower(trim(explode("|", $c)[1])));
                    $data[$count]['country'] = $country;
                    $data[$count]['company'] = $company;
                }
            }

            if ($node->filter($item_link)->count() > 0) {
                $data[$count]['link'] = $node->filter($item_link)->text();
            }


            $check = Derman::where("name", "=", $data[$count]['title'])
                ->where("price", "=", $data[$count]['price'])
                ->when(isset($data[$count]['country']), function ($query) use ($data, $count) {
                    return $query->where("country", "=", $data[$count]['country']);
                })
                ->when(isset($data[$count]['company']), function ($query) use ($data, $count) {
                    return $query->where("company", "=", $data[$count]['company']);
                })
                ->where("link", "=", $data[$count]['link'])
                ->where("site", "=", $site->id)
                ->first();

            if (is_null($check)) {
                $save = new Derman();
                $save->name =     $data[$count]['title'];
                $save->price =    $data[$count]['price'];
                $save->link =     $data[$count]['link'];
                $save->site =     $site->id;

                if (isset($data[$count]['country'])) {
                    $save->country = $data[$count]['country'];
                }

                if (isset($data[$count]['company'])) {
                    $save->company =  $data[$count]['company'];
                }
                $save->save();
            }
        });
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // }
        return view("Site/getdata", compact("data"));
    }

    public function addlink(Request $request)
    {
        $site = Site::find($request->id);
        return view("Site.addlink", compact("site"));
    }

    public function addlinkAction(Request $request)
    {
        $link = urldecode($request->link);

        $check = Site::find($request->id);

        if (is_null($check)) {
            return redirect()->back()->withErrors(['error' => "Belə sayt tapılmadı"]);
        }

        $has_link = Site::where("link", "=", $link)->first();
        if (!is_null($has_link)) {
            return redirect()->back()->withErrors(['error' => "Bu link daha əvvəl yüklənib."]);
        }
        $save = new Link();

        $save->link = $link;
        $save->site_id = $request->id;
        $save->save();

        return redirect("/site/" . $request->id . "/links");
    }

    public function getlinks(Request $request)
    {
        $link = $request->id;
        $site = Site::find($request->id);

        if (is_null($site)) {
            return redirect()->back()->withErrors(['error' => "Belə sayt tapılmadı"]);
        }

        $data = Link::where("site_id", "=", $site->id)->get();


        return view("Site.getlinks", compact("data", "site"));
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $site = Site::find($id);

        if (is_null($site)) {
            return redirect()->back()->withErrors(['error' => "Site tapılmadı"]);
        }

        return view("Site.edit", compact("site"));
    }

    public function editAction(Request $request)
    {
        $id = $request->id;

        $site = Site::find($id);

        if (is_null($site)) {
            return redirect()->back()->withErrors(['error' => "Site tapılmadı"]);
        }


        $name = $request->name;
        $domen = $request->domen;
        $link = $request->link;
        $has_retail = $request->has_retail;
        $iterable = $request->iterable;
        $title = $request->title;
        $title2 = $request->title2;
        $price = $request->price;
        $country = $request->country;
        $company = $request->company;
        $items_per_page = $request->items_per_page;
        $pagination = $request->pagination;


        $site->name = $name;
        $site->domen = $domen;
        $site->link = $link;
        $site->iterable = $iterable;
        $site->has_retail = $has_retail;
        $site->title = $title;
        $site->title2 = $title2;
        $site->price = $price;
        $site->company = $company;
        $site->country = $country;
        $site->items_per_page = $items_per_page;
        $site->pagination = $pagination;

        $site->update();

        return redirect(route("sites"))->with(["success" => "Sayta düzəliş edildi"]);
    }

    public function deleteLink(Request $request)
    {
        $link_id = $request->id;

        $link = Link::find($request->id);

        if (is_null($link)) {
            return redirect()->back()->withErrors(['error' => "Belə link tapılmadı"]);
        }

        $link->delete();

        return redirect(route("links", ['id' => $link->site_id]))->with(["success" => "Link bazadan silindi"]);
    }


    public function deleteSite(Request $request)
    {
        $site_id = $request->id;

        $site = Site::find($request->id);

        if (is_null($site)) {
            return redirect()->back()->withErrors(['error' => "Belə site tapılmadı"]);
        }

        $site->delete();

        return redirect(route("sites", ['id' => $site->id]))->with(["success" => "Site bazadan silindi"]);
    }

    public function wolt()
    {

        // $response = Http::get("https://restaurant-api.wolt.com/v4/venues/slug/zafaran-khatai-aptek/menu/categories/slug/drmanlar-v-qida-lavlri-2?unit_prices=true&show_weighted_items=true&show_subcategories=true");
        $category = [
            "ampoules-2",
            "aerosols-3",
            "aerosols-3",
            "balsam-4",
            "gel-7",
            "for-babies-30",
            "infusions-10",
            "capsules-5",
            "drops-8",
            "cosmetics-11",
            "creams-12",
            "contraception-31",
            "lotions-13",
            "ointments-14",
            "oils-15",
            "medical-devices-32",
            "adult-diapers-34",
            "packages-16",
            "pastiles-17",
            "patches-18",
            "powders-19",
            "solution-21",
            "candles-6",
            "sachet-22",
            "syrups-23",
            "sprays-24",
            "suppositories-26",
            "suspensions-27",
            "pills-1",
            "herbs-33",
            "vials-29",
            "shampoo-28",
            "other-20",
        ];
        $count = 0;
        foreach ($category as $cat) {
            $response = Http::get("https://restaurant-api.wolt.com/v4/venues/slug/zeytun-aptek-223/menu/categories/slug/" . $cat . "?unit_prices=true&show_weighted_items=true&show_subcategories=true");
            $data = $response->json();

            foreach ($data['items'] as $key => $item) {
                $count++;
                echo $count . ") " . $item['name'] . " Qiymət: " . ($item['baseprice'] / 100) . "<br/>";
            }
        }
    }

    public function curl()
    {
        $response = Http::get('https://pharmastore.az');
        $html = $response->body();

        $crawler = new Crawler($html);

        // İlgilendiğiniz verilere erişin ve işleyin
        // $title = $crawler->filter('div')->text();
        print_r($crawler);
    }


    public function tafsir(Request $r)
    {
        $id = $r->id;
        $page = isset($r->page) ? (!empty($r->page) ? "hoha" : "bibib") : 1;

        $site = Site::find($id);
        if ($site == null) {
            return redirect()->back()->withErrors(["error" => "Bazada parse ediləcək sayt tapılmadı"]);
        }

        $iterated = $site->iterable;
        $title = $site->title;
        $price = $site->price;
        $item_link = $site->item_link;
        $cc = $site->company;

        $base_url = 'https://' . explode('/', str_replace('https://', '', $r->site))[0];

        $data = [];

        $count = 0;
        // for ($k = 1; $k <= 1; $k++) {

        $client = new Client();
        // $crawler = $client->request('GET', $site->link . "?page=" . $page);
        $crawler = $client->request('GET', "https://quranenc.com/az/browse/turkish_mokhtasar/3" . "?page=" . $page);

        $crawler->filter($iterated)->each(function (Crawler $node, $i) use (&$data, &$site, &$iterated, &$title, &$price, &$item_link, &$cc, &$k, &$count) {
            $count++;

            if ($node->filter($title)->count() > 0) {
                $data[$count]['title'] = $node->filter($title)->text();
                // $data[$count]['url'] = $node->filter($item_link)->attr('href');
            }

            if ($node->filter(".aya-anchor")->count() > 0) {
                $data[$count]['aya_number'] = $node->filter(".aya-anchor")->attr("id");
            }



            if ($node->filter($price)->count() > 0) {
                $data[$count]['price'] = $node->filter($price)->text();
            } else {
                $data[$count]['price'] = 0;
            }
            if (!is_null($cc)) {
                if ($node->filter($cc)->count() > 0) {
                    $c = $node->filter($cc)->text();
                    $c = str_replace("i̇", "i", $c);
                    $country = ucfirst(mb_strtolower(trim(explode("|", $c)[0])));
                    // $company = ucfirst(mb_strtolower(trim(explode("|", $c)[1])));
                    $data[$count]['country'] = $country;
                    // $data[$count]['company'] = $company;
                }
            }

            // if ($node->filter($item_link)->count() > 0) {
            //     $data[$count]['link'] = $node->filter($item_link)->text();
            // }


            $check = Derman::where("name", "=", $data[$count]['title'])
                ->where("price", "=", $data[$count]['price'])
                ->when(isset($data[$count]['country']), function ($query) use ($data, $count) {
                    return $query->where("country", "=", $data[$count]['country']);
                })
                ->when(isset($data[$count]['company']), function ($query) use ($data, $count) {
                    return $query->where("company", "=", $data[$count]['company']);
                })
                // ->where("link", "=", $data[$count]['link'])
                ->where("site", "=", $site->id)
                ->first();

            // if (is_null($check)) {
            //     $save = new Derman();
            //     $save->name =     $data[$count]['title'];
            //     $save->price =    $data[$count]['price'];
            //     $save->link =     $data[$count]['link'];
            //     $save->site =     $site->id;

            //     if (isset($data[$count]['country'])) {
            //         $save->country = $data[$count]['country'];
            //     }

            //     if (isset($data[$count]['company'])) {
            //         $save->company =  $data[$count]['company'];
            //     }
            //     $save->save();
            // }
        });


        foreach ($data as $key => $d) {
            // $find = Tafsir::where("tafsir_text","=", $d['price'])->first();
            echo $d["aya_number"] . ") " . $d['price'] . "<br/>---<br/>";
        }
    }
}
