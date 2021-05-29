<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{


    public function createOrder(Request $request)
    {
        $requestParams = $request->only(['product_id']);
        $user = Auth::guard('api')->user();

        $getProductDetail = Product::whereId($requestParams['product_id'])->first();
        $amount = (int)$getProductDetail->price;

        $orders = new Order();
        $orders->user_id = $user->id;
        $orders->product_id = $requestParams['product_id'];
        $orders->quantity = 1;
        $orders->shipping_fees = 50;
        $orders->amount = $amount;
        $orders->sku = Str::random(15);
        $orders->order_number = mt_rand(100000, 999999);;
        $orders->status = 'in_cart';

        $orders->save();

        return OrderResource::make($orders)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function updateCart(Request $request)
    {
        $requestParams = $request->only(['id', 'quantity']);

        $orders = Order::whereId($requestParams['id'])->first();

        $getProductDetail = Product::whereId($orders['product_id'])->first();
        $productPrice = (int)$getProductDetail->price;

        $orders->quantity = $requestParams['quantity'];
        $orders->amount = $productPrice * (int)$requestParams['quantity'];

        $orders->save();

        return OrderResource::make($orders)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function myOrders()
    {
        $user = Auth::guard('api')->user();
        $orders = Order::query()
            ->whereUserId($user->id)
            ->whereStatus(Controller::$ORDER)
            ->get();
        return OrderResource::collection($orders)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function checkout()
    {
        $user = Auth::guard('api')->user();
        $orders = Order::query()
            ->whereUserId($user->id)
            ->get();

        if ($orders) {
            Order::where('user_id', $user->id)->update(array('status' => Controller::$ORDER));
        }
        $orders = Order::query()
            ->whereUserId($user->id)
            ->whereStatus(Controller::$ORDER)
            ->get();

        return OrderResource::collection($orders)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function myCarts()
    {
        $user = Auth::guard('api')->user();

        $carts = Order::query()
            ->whereUserId($user->id)
            ->whereStatus(Controller::$CART)
            ->get();
        return OrderResource::collection($carts)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function removeCarts($id)
    {
        $orders = Order::findOrFail($id);
        if ($orders) {
            Order::destroy($id);
        } else {
            return OrderResource::make($orders)->additional(['meta' => [
                    'code' => Controller::$FAIL,
                    'message' => __('no_order_found'),
                ]]
            );
        }
        return ProductResource::make($orders)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

}
