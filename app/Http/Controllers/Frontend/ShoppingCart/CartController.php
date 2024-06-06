<?php

namespace App\Http\Controllers\Frontend\ShoppingCart;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Carts\Carts;
use App\Models\Carts\CartsProducts;
use App\Models\Catalog\Discount;
use App\Models\Catalog\Product;
use App\Models\Orders\Delivery;
use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function select_slot(Request $request, Product $product)
    {
        return view('frontend.carts.partials.select_slot_modal_content', [
            'product' => $product,
            'chosed_cities' => $request->chosed_cities,
        ]);
    }

    public function chose_address()
    {
        $address = '';
        $cart_id = $this->getCart();
        if(Auth::check()){
            $address = Address::where('user_id', Auth::id())->get();
        } else {
            route('login');
        }
        return view('frontend.carts.chose_address', [
            'cart' => Carts::firstwhere('id', $cart_id),
            'address' => $address,
        ]);
    }

    public function create_address(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'max:255',
            'other' => 'max:255',
            'cities' => 'required',
            'country' => 'nullable',
            'phone' => 'required|string|max:20',
            'other_phone' => 'max:20',
            'favorite' => '',
        ]);
        $validated['user_id'] = Auth::user()->id;
        $validated['alias'] = "Mon adresse";
        $validated['country'] = "La Réunion";
        $user_address = Address::create($validated);
        $user_address->favorite = $user_address->id;
        $user_address->save();
        return $user_address;
    }

    public function chose_delivery(Request $request)
    {
        if($request->add_address) {
            $user_address = $this->create_address($request);
        } else {
            $user_address = Address::where('id', $request->address)->first();
        }
        return view('frontend.carts.chose_delivery', [
            'user_address' => $user_address,
            'user_address_fac' => Address::where('user_id', Auth::id())->where('favorite', '!=', '')->first(),
            'cart' => Carts::with('product')->firstwhere('id', $request->cart),
            'delivery' => Delivery::where('active', 1)->get(),
        ]);
    }
    public function chosed_delivery(Request $request)
    {
        /*** Inclut les points fidélité ***/
        return view('frontend.carts.partials.delivery_index', [
            'user_address' => Address::firstwhere('id', $request->address),
            'user_address_fac' => Address::where('user_id', Auth::id())->where('favorite', '!=', '')->first(),
            'cart' => Carts::with('product')->firstwhere('id', $request->cart),
            'delivery' => Delivery::where('active', 1)->get(),
            'delivery_chose' => Delivery::firstwhere('id', $request->deliver),
            'loyality' => User::select('erp_id', 'erp_loyalty_points', 'erp_loyalty_card')->firstwhere('id', Auth::user()->id),
        ]);
    }
    public function chosed_delivery_date(Request $request, string $delivery, string $delivery_date, string $delivery_slot)
    {
        /*** Inclut les points fidélité ***/
        return view('frontend.carts.partials.delivery_index', [
            'user_address' => Address::firstwhere('id', $request->address),
            'user_address_fac' => Address::where('user_id', Auth::id())->where('favorite', '!=', '')->first(),
            'cart' => Carts::with('product')->firstwhere('id', $request->cart),
            'delivery' => Delivery::where('active', 1)->get(),
            'delivery_chose' => Delivery::firstwhere('id', $request->deliver),
            'delivery_date' => $delivery_date,
            'delivery_slot' => $delivery_slot,
            'loyality' => User::select('erp_id', 'erp_loyalty_points', 'erp_loyalty_card')->firstwhere('id', Auth::user()->id),
        ]);
    }

    public function cart_summary(Request $request)
    {
        return view('frontend.carts.summary', [
            'user_address' => Address::firstwhere('id', $request->address),
            'user_address_fac' => Address::where('user_id', Auth::id())->where('favorite', '!=', '')->first(),
            'cart' => Carts::with('product')->firstwhere('id', $request->cart),
            'deliver' => Delivery::firstwhere('id', $request->delivery),
            'delivery_date' => $request->delivery_date,
            'delivery_slot' => $request->delivery_slot,
            'loyality' => $request->loyality,
        ]);
    }



    public function getCart(Request $request = null)
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
            if(@$request->postal_code) {
                $cart = Carts::create([
                    'session_id' => Session::getId(),
                    'status' => 'En cours',
                    'postal_code' => $request->postal_code,
                    'delivery_date' => $request->delivery_date,
                    'delivery_slot' => $request->delivery_slot,
                ]);
            } else {
                $cart = Carts::create([
                    'session_id' => Session::getId(),
                    'status' => 'En cours',
                ]);
            }

            cookie()->queue(cookie()->forever('session_id', $session_id));
            return $cart->id;
        }
    }

    public function add_product(Request $request, Product $produit)
    {
        $cart_id = $this->getCart($request);
        $cart = Carts::firstwhere('id', $cart_id);
        if (count($cart->product()->where('product_id', $produit->id)->get()) == 0)
        {
            if($request->quantity){
                $proquantity = $request->quantity;
            } else {
                $proquantity = 1;
            }
            /*** Retroune un array de tout les produits en promotion avec l'offre la plus avantageuse ***/
            $discountProducts = collect();
            $discounts = Discount::currently()->with('products')->orderBy('percentage')->get();
            foreach ($discounts as $discount) {
                $discountPercentage = $discount->percentage;
                foreach($discount->products as $product){
                    $discountProducts->put($product->product_id, $discount);
                }
            }
            if ($discountProducts->has($produit->id)) {
                $cart->product()->create([
                    'fav_image' => $produit->getFirstImagesURL(),
                    'product_id' => $produit->id,
                    'price_ht' => $produit->price_ht,
                    'tva' => $produit->tva,
                    'price_ttc' => $produit->price_ttc,
                    'quantity' => $proquantity,
                    'discount_id' => $discountProducts->get($produit->id)->id,
                    'discount_percentage' => $discountProducts->get($produit->id)->percentage,
                ]);
            } else {
                $cart->product()->create([
                    'fav_image' => $produit->getFirstImagesURL(),
                    'product_id' => $produit->id,
                    'price_ht' => $produit->price_ht,
                    'tva' => $produit->tva,
                    'price_ttc' => $produit->price_ttc,
                    'quantity' => $proquantity,
                ]);
            }

        } else {
            $product = CartsProducts::where('product_id', $produit->id)->first();
            if($request->quantity){
                $product->quantity = $request->quantity;
            } else {
                $product->quantity = $product->quantity + 1;
            }
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
    public function update_quantity_product(Request $request, $product)
    {
        $product = CartsProducts::where('id', $product)->first();
        $cart = Carts::where('id', $product->carts_id)->first();
        $product->quantity = $request->quantity;
        $product->save();
        return view('frontend.carts.cart_fragment', compact('cart'))->fragment('panier_fragment');
    }
    /*** Plus utiliser, Peut etre utilise pour un autre site.
    public function down_quantity_product($produit)
    {
        $product = CartsProducts::where('id', $produit)->first();
        $cart = Carts::where('id', $product->carts_id)->first();
        if($product->quantity != 1) $product->quantity = $product->quantity - 1;
        $product->save();
        return view('frontend.carts.cart_fragment', compact('cart'))->fragment('panier_fragment');
    }
    public function up_quantity_product($produit)
    {
        $product = CartsProducts::where('id', $produit)->first();
        $cart = Carts::where('id', $product->carts_id)->first();
        $stock = Product::find($product->product_id, ['stock']);
        if($product->quantity < $stock->stock) $product->quantity = $product->quantity + 1;
        $product->save();
        return view('frontend.carts.cart_fragment', compact('cart'))->fragment('panier_fragment');
    } ***/

    public function delete_product(CartsProducts $produit)
    {
        CartsProducts::find($produit)->each->delete();
        return back();
    }
}
