<?php

namespace App\Http\Controllers\Frontend\Orders;


use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Carts\Carts;
use App\Models\Catalog\Product;
use App\Models\Orders\OrderProducts;
use App\Models\Orders\Orders;
use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends FrontendBaseController
{

    private function redirectToExternalUrl($url, $data)
    {
        $formInputs = '';
        foreach ($data as $key => $value) {
            $formInputs .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
        }

        $html = '<html>
                    <body>
                        <form id="redirectForm" method="POST" action="' . htmlspecialchars($url) . '">
                            <input type="hidden" name="urlreturnvalid" value="1">
                            ' . $formInputs . '
                        </form>
                        <script type="text/javascript">
                            document.getElementById("redirectForm").submit();
                        </script>
                    </body>
                </html>';

        return response($html);
    }

    public function sendPaymentRequest(Request $request)
    {
        $cart = Carts::with('product')->findOrFail($request->cart);

        // Sauvegarde des informations de la livraison
        $cart->delivery_id = $request->deliver;
        $cart->user_address_delivery = $request->user_address_delivery;
        $cart->user_address_invoice = $request->user_address_invoice;

        // génération de l'id de transaction pour référencer le paiement
        $cart->payment_id = generateUniqueAn6();
        $cart->update();

        $redirectUrl = config('payment.redirect_url');
        $payment_obligatory_fields = config('payment.obligatory_fields');
        $payment_obligatory_fields['vads_trans_id'] = $cart->payment_id;
        $payment_obligatory_fields['vads_amount'] = $cart->total_ttc;
        $data = array_merge($payment_obligatory_fields, ['signature' => generateSignature( $payment_obligatory_fields )]);

        return $this->redirectToExternalUrl($redirectUrl, $data);
    }

    public function getPaymentReturn(Request $request)
    {
        if ($request->vads_auth_result = 00) {

            $this->cart_validation($request->vads_trans_id);
            return to_route('index')->withSuccess('Merci pour votre commande');
        } else {
            return to_route('index')->withError('Commande non effectué');
        }
    }

    // Enregistrement des toutes les informations de la commande
    public function cart_validation($payment_id)
    {
        // Récuperation des informations du panier
        $cart = Carts::with('product')->where('payment_id', '=', $payment_id)->first();
        $order = new Orders;

        $cart->status = 'Commander';
        $cart->update();
        $order->status_id = 3; // 'paiement accepté'
        $order->total_ttc = $cart->total_ttc;

        // Récuperation des informations de la livraison
        $order->delivery_id = $cart->delivery_id;
        $order->delivery_price = $cart->delivery_price;
        $order->delivery_date = $cart->delivery_date;
        $order->delivery_slot = $cart->delivery_slot;

        // Récuperation des informations de l'utilisateur
        $order->user_id = $cart->user_id;
        $order->user_loyality_used = $cart->loyality;
        if ($cart->loyality == 5) $order->user_loyality_points_used = 300;
        if ($cart->loyality == 10) $order->user_loyality_points_used = 500;
        if ($cart->loyality == 15) $order->user_loyality_points_used = 1000;

        $address_delivery = Address::findOrFail($cart->user_address_delivery);
        $order->user_name = $address_delivery->first_name.' '.$address_delivery->last_name;
        $order->user_email = Auth::user()->email;
        $order->user_delivery_address = $address_delivery->address;
        $order->user_delivery_address2 = $address_delivery->address2;
        $order->user_delivery_cities = $address_delivery->cities;
        $order->user_delivery_phone = $address_delivery->phone;
        $order->user_delivery_other_phone = $address_delivery->other_phone;
        /*** Champ pas encore present ***/
        $order->user_civilite = $address_delivery->civilite;
        $order->user_first_name = $address_delivery->first_name;
        $order->user_last_name = $address_delivery->last_name;
        $order->user_birthday = $address_delivery->birthday;

        if($cart->user_address_invoice != $cart->user_address_delivery) {
            $address_invoice = Address::findOrFail($cart->user_address_invoice);
            $order->user_invoice_first_name = $address_invoice->first_name;
            $order->user_invoice_last_name = $address_invoice->last_name;
            $order->user_invoice_address = $address_invoice->address;
            $order->user_invoice_address2 = $address_invoice->address2;
            $order->user_invoice_cities = $address_invoice->cities;
            $order->user_invoice_phone = $address_invoice->phone;
            $order->user_invoice_other_phone = $address_invoice->other_phone;
            /*** Champ pas encore present ***/
            $order->user_civilite = $address_delivery->civilite;
            $order->user_invoice_first_name = $address_invoice->first_name;
            $order->user_invoice_last_name = $address_invoice->last_name;
        }
        $order->save();
        /// Recuperation des informations produits + Mise a jour du stock
        foreach ($cart->product as $cart_product) {
            $orderProducts = new OrderProducts();
            $productInfo = Product::findOrFail($cart_product->product_id);
            $orderProducts->orders_id = $order->id;
            $orderProducts->carts_id = $cart_product->carts_id;
            $orderProducts->product_id = $cart_product->product_id;
            $orderProducts->code_article = $productInfo->code_article;
            $orderProducts->name = $productInfo->name;
            $orderProducts->short_description = $productInfo->short_description;
            $orderProducts->fav_image = $cart_product->fav_image;
            $orderProducts->barcode = $productInfo->barcode;
            $orderProducts->stock_unit = $productInfo->stock_unit;
            $orderProducts->weight_unit = $productInfo->weight_unit;
            $orderProducts->weight = $productInfo->weight;
            $orderProducts->price_ht = $cart_product->price_ht;
            $orderProducts->tva = $cart_product->tva;
            $orderProducts->price_ttc = $cart_product->price_ttc;
            $orderProducts->discount_id = $cart_product->discount_id;
            $orderProducts->discount_percentage = $cart_product->discount_percentage;
            $orderProducts->discount_fixed_price_ttc = $cart_product->discount_fixed_price_ttc;
            $orderProducts->quantity = $cart_product->quantity;
            $orderProducts->save();
            // Mise à jour stock
            if($orderProducts->stock_unit == 'unit') {
                $productInfo->stock = $productInfo->stock - ($cart_product->quantity * 1000);
                $productInfo->save();
            } elseif ($orderProducts->stock_unit == 'kg') {
                $productInfo->stock = $productInfo->stock - $cart_product->quantity;
                $productInfo->save();
            }
        }
        // Modification des points FID
        $user = User::findOrFail(Auth::user()->id);
        $user->erp_loyalty_points = $user->erp_loyalty_points - $order->user_loyality_points_used;
        $user->erp_loyalty_points = $user->erp_loyalty_points + round($cart->total_ttc / 100, 0);
        $user->save();
        cookie()->queue(cookie()->forget('session_id'));
    }
}
