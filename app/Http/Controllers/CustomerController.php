<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodModel;
use App\Models\OrderModel;
use App\Models\DetailModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //MELIHAT MENU
    public function getFood(){
        $dataFood=FoodModel::get();
        return response()->json($dataFood);
    }
    //MEMESAN MENU
    public function orderFood(Request $req){
        $timestamp = Carbon::now()->timestamp;
        $created_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        $datetime = Carbon::now()->toDateTimeString();
        
        $req->validate([
            'customer_name' => 'required',
            'table_number' => 'required',
            'order_date' => 'required|date',
            'order_detail' => 'required|array',
            'order_detail.*.food_id' => 'required|numeric',
            'order_detail.*.quantity' => 'required|integer|min:1',
        ]);
        $orderList = OrderModel::create([
            'customer_name' => $req->customer_name,
            'table_number' => $req->table_number,
            'order_date' => $req->order_date,
        ]);
        foreach ($req->order_detail as $detail) {
            $foodPrice = FoodModel::find($detail['food_id'])->price;
            $price = $foodPrice * $detail['quantity'];
            $orderList->OrderDetail()->create([
                'food_id' => $detail['food_id'],
                'quantity' => $detail['quantity'],
                'price' => $price,
            ]);
        }
        $responseData = [
            'status' => true,
            'message' => 'Order telah dibuat',
            'data' => $orderList,
        ];
        return response()->json($responseData);
    }
}
