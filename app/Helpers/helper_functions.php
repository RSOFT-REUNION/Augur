<?php

use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Support\Facades\Storage;
use League\Glide\Urls\UrlBuilderFactory;

function getActive($active)
{
    if ($active == 0) {
        echo '<span style="color: #b02a37;"><i class="fa-solid fa-rectangle-xmark fa-2x"></i></span>';
    } else {
        echo '<span style="color: #198754;"><i class="fa-solid fa-square-check fa-2x"></i></span>';
    }
}

function getImageUrl(string $image, ?int $width = null, ?int $height = null, ?string $fit = null)
{
    /*** verifie que l'image existe, sinon retroune l'image par default ***/
    if(Storage::files('/public'.$image) != '') {
        $image = '/no-image.png';
    }

    if ($width === null) {
        return '/storage'.$image;
        //return '/storage/upload/catalog/products/'.$this->product_id.'/'.$this->name;
    }
    $urlBuilder = UrlBuilderFactory::create('/images/', config('laravel-glide.key'));
    return $urlBuilder->getUrl($image, ['w' => $width, 'h' => $height, 'fit' => $fit]);
}


function getProductInfos($produit)
{
    $productinfo = Product::where('id', $produit)->first();
    return $productinfo;
}
function getCategoryParentInfo($category)
{
    return Category::where('id', $category)->first();
}

function formatPriceToInteger($input) {
    return round($input * 100);
}

function formatPriceToFloat($input) {
        return number_format(($input / 100), 2, ',', ' ') ;
}

function formatStocktoInteger($input) {
    return round($input  * 1000);
}

function formatStockToFloat($input) {
    return number_format(($input  / 1000), 3, ',', ' ');
}

function arrayToString(array $array)
{
    $retrun = '?';
    foreach ($array as $key => $value) {
        $retrun .= '&'.$key.'='.$value;
    }
    echo $retrun;
}

function csvToArray($filename = '', $delimiter = ';')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
}
