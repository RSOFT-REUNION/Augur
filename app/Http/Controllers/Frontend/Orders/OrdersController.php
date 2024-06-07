<?php

namespace App\Http\Controllers\Frontend\Orders;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Carts\Carts;
use App\Models\Catalog\Product;
use App\Models\Orders\Delivery;
use App\Models\Orders\Orders;
use App\Models\Users\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends FrontendBaseController
{
    // Enregistrement des toutes les informations de la commande
    public function cart_validation(Request $request)
    {
        $order = new Orders();
        // Récuperation des informations du panier
        $cart = Carts::with('product')->findOrFail($request->cart);
        //$cart->status = 'Commander';
        //$cart->save();
        $order->total_ttc = $cart->total_ttc;

        // Récuperation des informations de la livraison
        $order->delivery_id = $request->deliver;
        $order->delivery_price = $cart->delivery_price;
        $order->delivery_date = $cart->delivery_date;
        $order->delivery_slot = $cart->delivery_slot;

        // Récuperation des informations de l'utilisateur
        $order->user_id = $cart->user_id;
        $order->user_loyality_used = $cart->loyality;

        $address_delivery = Address::findOrFail($request->user_address_delivery);
        $order->user_name = $address_delivery->name;
        //$order->user_name = $address_delivery->last_name.' '.$address_delivery->last_name;
        $order->user_email = Auth::user()->email;
        $order->user_delivery_address = $address_delivery->address;
        $order->user_delivery_address2 = $address_delivery->address2;
        $order->user_delivery_cities = $address_delivery->cities;
        $order->user_delivery_phone = $address_delivery->phone;
        $order->user_delivery_other_phone = $address_delivery->other_phone;
        /*** Champ pas encore present ***/
        //$order->user_civilite = $address_delivery->civilite;
        //$order->user_first_name = $address_delivery->first_name;
        //$order->user_last_name = $address_delivery->last_name;
        //$order->user_birthday = $address_delivery->birthday;

        if($request['user_address_invoice'] != $request['user_address_delivery']) {
            $address_invoice = Address::findOrFail($request->user_address_invoice);
            //$order->name = $address_delivery->last_name.' '.$address_delivery->last_name;
            $order->user_invoice_address = $address_invoice->address;
            $order->user_invoice_address2 = $address_invoice->address2;
            $order->user_invoice_cities = $address_invoice->cities;
            $order->user_invoice_phone = $address_invoice->phone;
            $order->user_invoice_other_phone = $address_invoice->other_phone;
            /*** Champ pas encore present ***/
            //$order->user_civilite = $address_delivery->civilite;
            //$order->user_invoice_first_name = $address_invoice->first_name;
            //$order->user_invoice_last_name = $address_invoice->last_name;
        }
        dd($cart->product);
        /// Recuperation des informations produits
        foreach ($cart->product as $product) {
            $product = Product::findOrFail($product->id);
            dd($product);
        }
        dd($cart->product);
    }
}
