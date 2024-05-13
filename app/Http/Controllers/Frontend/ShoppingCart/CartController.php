<?php

namespace App\Http\Controllers\Frontend\ShoppingCart;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Carts\Carts;
use App\Models\Carts\CartsProducts;
use App\Models\Catalog\Product;
use App\Models\Orders\Delivery;
use App\Models\Users\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class CartController extends FrontendBaseController
{
    public function index()
    {
        $cart_id = $this->getCart();
        $cart = Carts::firstwhere('id', $cart_id);
        return view('frontend.carts.index', [
            'cart' => $cart,
        ]);
    }

    public function chose_address()
    {
        $address = '';
        $cart_id = $this->getCart();
        $cart = Carts::firstwhere('id', $cart_id);
        if(Auth::check()){
            $address = Address::where('user_id', Auth::id())->get();
        } else {
            return new HtmxResponseClientRedirect(route('login'));
        }
        return response()->view('frontend.carts.chose_address', [
            'cart' => $cart,
            'address' => $address,
        ]);
    }

    public function chose_delivery(Request $request)
    {
        $user_address = Address::where('id', $request->address)->first();
        $cart = Carts::with('product')->firstwhere('id', $request->cart);
        $delivery = Delivery::where('active', 1)->get();
        return view('frontend.carts.chose_livraison', [
            'user_address' => $user_address,
            'cart' => $cart,
            'delivery' => $delivery,
        ]);
    }

    public function chose_payment(Request $request)
    {
        $user_address = Address::where('id', $request->address)->first();
        $cart = Carts::with('product')->firstwhere('id', $request->cart);
        $deliver = Delivery::firstwhere('id', $request->delivery);
        $cart->delivery_id = $request->delivery;
        $cart->delivery_price = $deliver->price_ttc;
        $cart->total_ttc = $cart->delivery_price + $cart->countProductsPrice();
        $cart->save();
        return view('frontend.carts.summary', [
            'user_address' => $user_address,
            'cart' => $cart,
            'deliver' => $deliver,
        ]);
    }


    public function getCart()
    {
        $session_id = Session::getId();
        $cookie = @request()->cookie('session_id');
        /*** Recherche de panier ***/
        if($cart = Carts::where('session_id', $session_id)->orwhere('session_id', $cookie)->latest()->first()) {
            if(Auth::user()) {
                if($cart_user = Carts::where('user_id', Auth::id())->where('status', 'En cours')->first()){
                    return $cart_user->id;
                }
                $cart->update(['user_id' => Auth::id()]);
                return $cart->id;
            } else {
                cookie()->queue(cookie()->forever('session_id', $session_id));
                return $cart->id;
            }
        } else {
            $cart = Carts::create([
                'session_id' => Session::getId(),
                'status' => 'En cours',
            ]);
            cookie()->queue(cookie()->forever('session_id', $session_id));
            return $cart->id;
        }
    }
    public function add_product(Product $produit)
    {
        $cart_id = $this->getCart();
        $cart = Carts::firstwhere('id', $cart_id);
        if (count($cart->product()->where('product_id', $produit->id)->get()) == 0)
        {
            $cart->product()->create([
                'product_id' => $produit->id,
                'price_ht' => $produit->price_ht,
                'tva' => $produit->tva,
                'price_ttc' => $produit->price_ttc,
                'quantity' => 1,
            ]);
        } else
        {
            $product = CartsProducts::where('product_id', $produit->id)->first();
            $product->quantity = $product->quantity + 1;
            $product->save();
        }
        $sum = 0;
        foreach ($cart->product as $prod) {
            $sum += $prod->quantity;
        }
        return '<span id="nb_produit">'.$sum.'</span>';
    }

    public static function count_product()
    {
        if(Auth::user()) {
            if($cart = Carts::where('user_id', Auth::id())->where('status', 'En cours')->first()){
                cookie()->queue(cookie()->forever('session_id', $cart->session_id));
                $cookie = $cart->session_id;
            } else {
                cookie()->queue(cookie()->forever('session_id', @request()->cookie('session_id')));
                $cookie = @request()->cookie('session_id');
            }
        } else {
            $cookie = @request()->cookie('session_id');
        }
        $cart = Carts::where('session_id', $cookie)->first();
        if($cart != null) {
            $sum = 0;
            foreach ($cart->product as $prod) {
                $sum += $prod->quantity;
            }
            return $sum;
        } else {
            return 0;
        }
    }

    public function down_quantity_product($produit)
    {
        $product = CartsProducts::where('id', $produit)->first();
        $cart = Carts::where('id', $product->carts_id)->first();
        if($product->quantity != 1) $product->quantity = $product->quantity - 1;
        $product->save();
        return view('frontend.carts.panier_fragment', compact('cart'))->fragment('panier_fragment');
    }
    public function up_quantity_product($produit)
    {
        $product = CartsProducts::where('id', $produit)->first();
        $cart = Carts::where('id', $product->carts_id)->first();
        $stock = Product::find($product->product_id, ['stock']);
        if($product->quantity < $stock->stock) $product->quantity = $product->quantity + 1;
        $product->save();
        return view('frontend.carts.panier_fragment', compact('cart'))->fragment('panier_fragment');
    }
    public function delete_product(CartsProducts $produit)
    {
        CartsProducts::find($produit)->each->delete();
        return back();
    }
}
