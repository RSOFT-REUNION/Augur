<?php

use App\Models\Catalog\Product;

function getActive($active)
{
    if ($active == 0) {
        echo '<span style="color: #b02a37;"><i class="fa-solid fa-rectangle-xmark fa-2x"></i></span>';
    } else {
        echo '<span style="color: #198754;"><i class="fa-solid fa-square-check fa-2x"></i></span>';
    }
}

function getProductInfos($produit)
{
    $productinfo = Product::where('id', $produit)->first();
    return $productinfo;
}
