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
    if(Storage::files('/public'.$image)) {
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
function removeStorageFromURL($path)
{
    return substr($path, 8);
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

/*** Fonction qui retourne les dates sur les 2 prochaines semaine ***/
function getDaysTwoWeeks (string $region)
{
    // Créer un objet DateTime avec la date actuelle
    $date = new DateTime();
    // Ajouter 2 jours à la date actuelle
    $date->modify('+1 days');
    // Liste des jours que nous recherchons en anglais et leur traduction en français
    if($region == 'nord') {
        $targetDays = [
            'Monday' => 'Lundi',
            'Wednesday' => 'Mercredi',
            'Friday' => 'Vendredi'
        ];
    } else {
        $targetDays = [
            'Tuesday' => 'Mardi',
            'Thursday' => 'Jeudi',
            'Saturday' => 'Samedi'
        ];
    }
    $possibleDays = getDaysOverTwoWeeks($date, $targetDays);
    return $possibleDays;
}

// Fonction pour trouver les jours possibles sur 2 semaines
function getDaysOverTwoWeeks(DateTime $date, array $days) {
    $results = [];
    $interval = new DateInterval('P1D'); // Intervalle d'un jour
    $period = new DatePeriod($date, $interval, 13); // Période de 14 jours
    foreach ($period as $day) {
        $dayName = $day->format('l');
        if (array_key_exists($dayName, $days)) {
            $results[] = [
                'date' => $day,
                'day' => $days[$dayName]
            ];
        }
    }
    return $results;
}
// Fonction pour formater une date en français
function formatDateInFrench(DateTime $date) {
    $formatter = new IntlDateFormatter(
        'fr_FR',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Europe/Paris',
        IntlDateFormatter::GREGORIAN
    );
    return $formatter->format($date);
}
