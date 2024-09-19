<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodModel;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //LOGIN SEBAGAI ADMIN
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    //MENAMBAH MENU
    public function addFood(Request $req){
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'spicy_level'=>'required',
            'price'=>'required',
            'image'=>'required|image'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
        }
        $save = FoodModel::create([
            'name' => $req->get('name'),
            'spicy_level' => $req->get('spicy_level'),
            'price' => $req->get('price'),
            'image' => $filename
        ]);
        if($save){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan']);
        }
    }
    //MENGUBAH MENU
    public function updateFood(Request $req, $id){
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'spicy_level'=>'required',
            'price'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $update = FoodModel::where('id',$id)->update([
            'name' => $req->get('name'),
            'spicy_level' => $req->get('spicy_level'),
            'price' => $req->get('price'),
        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses mengubah']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah']);
        }
    }
    //MENGHAPUS MENU
    function deleteFood($id){
        $delete=FoodModel::where('Id',$id)->delete();
        if($delete){
            return Response()->json(['status'=>true,'message' => 'sukses menghapus']);
       } else {
            return Response()->json(['status'=>false,'message' => 'gagal menghapus']);
       }
    }
    //MELIHAT HISTORY TRANSAKSI
    public function getTransaction(){
        $history = OrderModel::with('OrderDetail')->get();

        $responseData = [
            'status' => true,
            'data' => $history,
        ];

        return response()->json($responseData);
    }
}
