<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Illuminate\Support\Facades\File;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $company = 'Baku Electronics';
        $url = 'https://www.bakuelectronics.az/catalog/';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $data = [];
        $crawler->filter('.showcase-section')->each(function(Crawler $node, $i) use(&$data){
            if($node->filter('.title-holder')->count() > 0){
                $data[$i]['section'] = $node->filter('.title-holder')->text();
            }
            if($node->filter('.item')->count()>0){
                $node->filter(".item")->each(function(Crawler $node2, $i2) use(&$data,$i){
                    if($node2->filter('.item-name')->count() > 0){
                        $data[$i]['item'][$i2]['title'] = $node2->filter('.item-name')->text();
                    }

                    if($node2->filter('.item__link')->count()>0){
                        $link = $node2->filter('.item__link')->attr('href');
                        $category = str_replace('https://www.bakuelectronics.az/catalog/','',$link);
                        // $explode = explode('/', $category);
                        // $data[$i][$i2]['url'] = $explode[0];
                        $data[$i]['item'][$i2]['url'] = $category;
                    }

                });

                // echo "<pre>";
                //     print_r($data);
                // echo "</pre>";
            
            }

        });
        return view('index', compact('data'));
    }

    public function getFromCategory(Request $r)
    {
        $base_url = 'https://www.bakuelectronics.az/';
        $page = $r->page ? $r->page : 1;
        $category = $r->url;
        $company = 'Baku Electronics';
        $link = 'https://www.bakuelectronics.az/catalog/'.$category."/?page=".$page;
        // echo $link;
        // exit;
        $client = new Client();
        $crawler = $client->request('GET', $link);
        
        $data = [];
        $crawler->filter('.product__card')->each(function(Crawler $node, $i) use(&$data){
            if($node->filter(".product__title")->count()>0){
                $data[$i]['title'] = $node->filter(".product__title")->text();
                $data[$i]['url'] = $node->filter(".product__title")->attr('href');
            }
            if($node->filter('.product__img')->count()>0){
                $data[$i]['image'] = $node->filter('.product__img')->attr('src');
            }
            if($node->filter('.product__price--cur')->count() > 0){
                    // echo $node->filter('.product__price--cur')->text()."<br/>";
                    $data[$i]['price'] = $node->filter('.product__price--cur')->text();
            }
        });

        return view('items',compact('data','company','link','page','category','base_url'));
    }

    public function items()
    {
        return view('items');
    }

    public function getFrom(Request $r)
    {
        return view('getFromLink');
    }

    public function getFromAction(Request $r)
    {
        $base_url = 'https://'.explode('/', str_replace('https://','',$r->link))[0];
        $page = $r->page ? $r->page : 1;
        $category = $r->url;
        $company = 'Baku Electronics';
        $domen = str_replace('www.','',explode('/', str_replace('https://','',$r->link))[0]);
        $link = $r->link;
        // exit;
        $client = new Client();
        $crawler = $client->request('GET', $link);
        
        $data = [];
        if($domen == 'bakuelectronics.az'){
        $crawler->filter('.product__card')->each(function(Crawler $node, $i) use(&$data){
            if($node->filter(".product__title")->count()>0){
                $data[$i]['title'] = $node->filter(".product__title")->text();
                $data[$i]['url'] = $node->filter(".product__title")->attr('href');
            }
            if($node->filter('.product__img')->count()>0){
                $data[$i]['image'] = $node->filter('.product__img')->attr('src');
            }
            if($node->filter('.product__price--cur')->count() > 0){
                    // echo $node->filter('.product__price--cur')->text()."<br/>";
                    $data[$i]['price'] = floatval($node->filter('.product__price--cur')->text());
            }
        });
        }else{
            $crawler->filter('.cart-item')->each(function($node, $i) use(&$data){
            if($node->filter('.name')->count() > 0){
                $data[$i]['title'] = $node->filter('.name > a')->text();
                
                if($node->filter('.nprice')->count()>0){
                    $data[$i]['price'] = trim(str_replace('M','',$node->filter('.nprice')->text()));
                }

                if($node->filter('.imgHolder img')->count()>0){
                    $data[$i]['image'] = $node->filter('.imgHolder img')->attr('data-src');
                }

                if($node->filter('.imgHolder a')->count() > 0){
                    $data[$i]['url'] = $node->filter('.imgHolder a')->attr('href');
                }
            }
        });
        }

        $saved = [];

        if(count($data)>0){
            foreach($data as $k=>$dt){
                $check = Product::where('title',"=",$dt['title'])->where('price',"=",$dt['price'])->where('link',"=",$dt['url'])->where('image',"=",$dt['image'])->first();
                if($check){
                    $saved[$k] = $dt;
                }else{
                    $new = new Product();
                    $new->title = $dt['title'];
                    $new->price = $dt['price'];
                    $new->link = $dt['url'];
                    $new->image = $dt['image'];
                    $new->domen = $domen;
                    $new->save();
                }
            }
        }

        return view('items',compact('data','company','link','page','category','base_url','saved','domen'));
    }

    public function automation(Request $r)
    {
        return view('automation');
    }

    public function automationAction(Request $r)
    {
        $site = $r->site;
        $iterated = $r->iterated;
        $name = $r->name;
        $price = $r->price;
        $image = $r->image;
        $link = $r->link;

        // echo $name;
        // exit;


        $base_url = 'https://'.explode('/', str_replace('https://','',$r->site))[0];
        $page = $r->page ? $r->page : 1;

        $client = new Client();
        $crawler = $client->request('GET', $site);
        
        $data = [];
        $crawler->filter($iterated)->each(function(Crawler $node, $i) use(&$data,&$site,&$iterated, &$name, &$price, &$image, &$link){
            // print_r($node->html());
            if($node->filter($name)->count()>0){
                $data[$i]['title'] = $node->filter($name)->text();
                $data[$i]['url'] = $node->filter($link)->attr('href');
            }
            if($node->filter($image)->count()>0){
                $data[$i]['image'] = $node->filter($image)->attr('src');
            }
            if($node->filter($price)->count() > 0){
                    $data[$i]['price'] = $node->filter($price)->text();
            }
        });
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        // return view('items',compact('data','company','link','page','category','base_url'));
        
    }

    public function maxi()
    {
        // $site = 'https://maxi.az/';

        // $client = new Client();
        // $crawler = $client->request('GET', $site);

        // echo $crawler->filter('body')->html();

        $client = new Client();
        $crawler = $client->request('GET', "http://localhost:8000/maxi/");

        print_r($crawler);
        // $crawler->filter('.body')->each(function(Crawler $node, $i) use(&$data){
        //     echo 
        // });

    }

    public function web()
    {
        $host = 'http://192.168.1.103:4444/';

        $capabilities = DesiredCapabilities::firefox();
        
        $driver = RemoteWebDriver::create($host, $capabilities);

        $driver->get('https://www.w-t.az');
        foreach($driver->findElements(WebDriverBy::cssSelector('.HomePageProductContainer_container__1gGUb')) as $el){
            File::append(public_path('w-t.html'), $el);
        }
        $driver->quit();

        // foreach($driver->findElements(WebDriverBy::cssSelector('.Card_paddingForMobile__1rs46')) as $el){
        //     // echo $el->getText()."<br/>";
        //     echo $el->findElement(WebDriverBy::cssSelector('.Card_name__1XHhF h3'))->getText()." [";
        //     echo $el->findElement(WebDriverBy::cssSelector('.Card_price__1zbkA'))->getText()." AZN ] <br/>";
        // }
        
        
    }


    public function wt()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://localhost:8000/w-t.html');

        
        print_r($crawler);
        $filteredData = $crawler->filter('.Card_price__1zbkA')->each(function ($node) {
            echo $node->text()."<br/>";
        });
    }




    public function text(Request $r)
    {
        $x = "Samsung A03 64GB";
        $y = "A03 64GB";
        similar_text($x,$y,$p);
        echo $p;
    }


    public function word(){
         $client = new Client();
            $crawler = $client->request('GET', 'https://www.w-t.az/mehsul/6319f85661d2a051c565948f/apple-iphone-14-pro-max-128gb-deep-purple');

            // print_r($crawler);
            $crawler->filter('.PriceandSaleContainer_priceContainer__1sy-v')->each(function($node){
                print_r($node->text());
            });

            $crawler->filter('body')->each(function($node, $i) use(&$data){
                print_r($node);
            });
            
    }


    public function turbo(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://auto.az');

        // print_r($crawler);
        $crawler->filter('.cat_ul2 li')->each(function($node){
            if($node->filter('div')->count()>0){
                echo $node->filter('div')->text()."<br/>";
                if($node->filter('span.b')->count()>0){
                    echo "Qiymət: ";
                    echo $node->filter('span.b')->text()."<br/>";
                }
                $url = $node->filter('a')->attr('href');
                echo "<a href='http://auto.az/".$url."'>Elana get</a><br/>";
            }
        });

        // $crawler->filter('body')->each(function($node, $i) use(&$data){
        //     print_r($node);
        // });
            
    }
}
