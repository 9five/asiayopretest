<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $currency = $request->currency;
        $price = $request->price;
        if ($currency == 'USD') {
            $currency = 'TWD';
            $price *= 31;
        }

        $address = Address::firstOrCreate(
            [
                'city' => $request->address['city'],
                'district' => $request->address['district'],
                'street' => $request->address['street'],
            ]
        );
        $order = new Order([
            'oid' => $request->id,
            'name' => $request->name,
            'address' => $address->id,
            'price' => $price,
            'currency' => $currency,
        ]);
        $order->save();

        return [
            'id' => $order->oid,
            'name' => $order->name,
            'address' => ['city' => $address->city, 'cistrict' => $address->district, 'street' => $address->street],
            'price' => $order->price,
            'currency' => $order->currency,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
