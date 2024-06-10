<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\Controller;
use App\Models\Orders\Orders;
use App\Models\Orders\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.orders.orders.index', [
            'orders' => Orders::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = new Orders();
        return view('backend.orders.orders.form', [
            'orders' => $orders,
            'status_list' => Status::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'delivery_type' => 'required|string',
            'delivery_location' => 'required|max:255|string',
            'status_id' => 'required',
            'user_id' => 'required',
            'total' => 'required|string|min:1|max:10',
        ]);
        Orders::create($validatedData);
        return redirect()->route('backend.orders.orders.index')->withSuccess('Commande ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $order)
    {
        return view('backend.orders.orders.form', [
            'order' => $order,
            'status_list' => Status::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $order)
    {
        $validatedData = $request->validate([
            'delivery_type' => 'required|string',
            'delivery_location' => 'required|max:255|string',
            'status_id' => 'required',
            'total' => 'required|string|min:1|max:10',
        ]);
        Orders::where('id', $order->id)->update($validatedData);
        return redirect()->route('backend.orders.orders.index')->withSuccess('Commande modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $order)
    {
        $order->delete();
        return back()->withSuccess('Commande supprimée avec succès');
    }
}
