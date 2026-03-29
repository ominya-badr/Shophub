<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addAtCart(Request $request, $id)
    {
        $product = Product::find($id);

        $cart = session('cart', []);

        if(isset(($cart[$id]))){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else{
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image,
                'description' => $product->description,
            ];
        }


        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product Added To The Cart.');
    }

    public function cart() {
        return view('carts.cart');
    }

    public function cartUpdate(Request $request)
    {
        $cart = session('cart');

        if($request->type == 'update') {
            $cart[$request->product_id]['quantity'] = $request->quantity;
        }else {
            unset($cart[$request->product_id]);
        }

        session()->put('cart', $cart);

        $view = view('carts.cartProducts')->render();

        return response()->json(["success" => $view]);
    }

    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
        ]);

        $amount = 0;

        foreach(session('cart') as $key => $value) {
            $order->products()->create([
                'product_id' => $key,
                'quantity' => $value['quantity'],
                'price' => $value['price']
            ]);

            $amount = $amount + ($value['quantity'] * $value['price']);
        }

        $order->amount = $amount;
        $order->save();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $successURL = route('order.success').'?session_id={CHECKOUT_SESSION_ID}&order_id='.$order->id;

        $response = $stripe->checkout->sessions->create([
            'success_url' => $successURL,
            "customer_email" => auth()->user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        "product_data" => [
                            "name" => "shopping",
                        ],
                        "unit_amount" => 100 * $amount,
                        "currency" => "USD",
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment'
        ]);

        return redirect($response['url']);
    }

    public function orderSuccess(Request $request) {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if($session->status == "complete") {
            $order = Order::find($request->order_id);

            $order->status = 1;
            $order->stripe_id = $session->id;
            $order->save();

            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Order Placed');
        }
        $order = Order::find($request->order_id);

        $order->status = 2;
        $order->save();

        dd("Failed");
    }
}
