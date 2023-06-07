<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

class KontaktHomeController extends Controller
{
    public function index()
    {
        return view('getfromlink');
    }

    public function getFrom(Request $r)
    {
        $base_url = 'https://www.kontakt.az/';
        $company = 'Kontakt Home';
        $page = $r->page ? $r->page : 1;
        $category = $r->url;
        $link = 'https://www.kontakt.az/'.$category."/page/".$page."/";
        $client = new Client();
        $crawler = $client->request('GET', $link);

        $data = [];

        

        return view('items', compact('data', 'company', 'page','category','link','base_url'));
    }


    public function detail(Request $request){
        $data = [];
        $url = $request->url;
        $prefix = 'https://kontakt.az/';

        $link = $prefix.$url;
        $client = new Client();
        $crawler = $client->request('GET', $link);

        echo "<pre>";
        $crawler->filter('.payment-option ul li')->each(function(Crawler $node, $i) use(&$data){
            if($node->filter('p')->count() >0){
                echo $node->filter('p')->attr('data-month')." - ";
                echo $node->filter('p')->attr('data-amount')."<br/>";
            }
        });
        echo "</pre>";
    }
}
