<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;



class SeleniumController extends Controller
{
    // public function scrapePharmastore()
    // {
    //     $host = 'http://localhost:4444/wd/hub'; // Selenium WebDriver serverin URL-i

    //     $capabilities = DesiredCapabilities::chrome();
    //     $driver = RemoteWebDriver::create($host, $capabilities);

    //     $driver->get('https://pharmastore.az/products');

    //     // Saytda axtarış formunu tapmaq üçün CSS selectorunu istifadə edirik
    //     // $searchInput = $driver->findElement(WebDriverBy::cssSelector('#search'));
    //     // $searchInput->sendKeys('paracetamol');
    //     // $searchInput->submit();

    //     // Axtarış nəticələrini əldə etmək üçün CSS selectorunu istifadə edirik
    //     // Qiyməti gözləmək üçün waitForElementVisible metodunu istifadə edirik
    //     $driver->wait()->until(
    //         WebDriverExpectedCondition::visibilityOfElementLocated(
    //             WebDriverBy::cssSelector('.product_box')
    //         )
    //     );

    //     $results = $driver->findElements(WebDriverBy::cssSelector('.product_box'));

    //     $scrapedData = [];

    //     foreach ($results as $result) {
    //         // Hər bir məhsulün adını və qiymətini əldə etmək üçün CSS selectorlarını istifadə edirik
    //         $name = $result->findElement(WebDriverBy::cssSelector('a>h4.text-normal'))->getText();
    //         $price = $result->findElement(WebDriverBy::cssSelector('.main-price'))->getText();

    //         $scrapedData[] = [
    //             'name' => $name,
    //             'price' => $price,
    //         ];
    //     }
    //     echo "<pre>";
    //     print_r($scrapedData);
    //     echo "</pre>";
    //     $driver->quit();

    //     // return response()->json($scrapedData);
    // }


    public function scrapePharmastore()
    {
        $url = 'https://www.pharmastore.az/products'; // Scraping yapmak istediğiniz sitenin URL'si

        $driver = \Facebook\WebDriver\Remote\RemoteWebDriver::create(
            'http://localhost:4444/wd/hub', // Selenium WebDriver server URL'si
            \Facebook\WebDriver\Remote\DesiredCapabilities::chrome()
        );

        $driver->get($url);

        sleep(5);
        $this->waitForElement($driver, '.product_box');

        $products = [];

        // while (true) {
        $productElements = $driver->findElements(WebDriverBy::cssSelector('.product_box'));

        foreach ($productElements as $productElement) {
            $name = $productElement->findElement(WebDriverBy::cssSelector('a>h3.text-normal'))->getText();
            $price = $productElement->findElement(WebDriverBy::cssSelector('.main-price'))->getText();

            $products[] = [
                'name' => $name,
                'price' => $price,
            ];
        }

        // $this->scrollDown($driver);

        // sleep(10);

        // $newProductElements = $driver->findElements(WebDriverBy::cssSelector('.product-box'));

        // Yeni bir ürün gelmediyse döngüyü sonlandır
        // if (count($newProductElements) == count($productElements)) {
        //     break;
        // }
        // }
        // foreach ($products as $product) {
        //     echo 'Name: ' . $product['name'] . ' - Price: ' . $product['price'] . '<br>';
        // }

        print_r($products);
        $driver->quit();
    }

    private function waitForElement(
        $driver,
        $selector,
        $timeout = 10
    ) {
        $driver->wait($timeout)->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector($selector))
        );
    }

    private function scrollDown($driver)
    {
        $driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
        sleep(10); // İstediğiniz gecikme süresini burada belirleyebilirsiniz
    }
}
