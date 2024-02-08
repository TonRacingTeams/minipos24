<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function __construct(){
        // $this->middleware('auth:api', ['except' =>['login', 'register']]);
        $this->middleware('auth:api');
    }

    public function index(){
        

        //ການດືງຂໍ້ມູນຈາກຕາລາງ ສົ່ງໄປສະແດງຜົນ

        $store = Store::orderBy('id','asc')
        ->paginate(5)
        ->toArray();

        return array_reverse($store);


        // $store = Store::orderBy('id','asc')->get();
        // return $store;
    }

    public function add(Request $request){

        try{

            //ເພີ່ມຂໍ້ມູນລົງຕາຕະລາງ

            $store = new Store([
                'name' => $request->name,
                'amount' => $request->amount,
                'price_buy' => $request->price_buy,
                'price_sell' => $request->price_sell
            ]);
            $store->save();
            $success = true;
            $message = 'ບັນທຶກຂໍ້ມູນສຳເລັດ !';

        }catch (\Illuminate\Database\QueryException $ex) {

            $success = false;
            $message = $ex->getMessage();

        }

        $respone = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($respone);
    }


    public function edit($id){
        $store = Store::find($id);
        return $store;
    }

    public function update($id,Request $request){
        try{

            //ເພີ່ມຂໍ້ມູນລົງຕາຕະລາງ
            $store = Store::find($id);
            $store->update([
                'name' => $request->name,
                // 'image' => ,
                'amount' => $request->amount,
                'price_buy' => $request->price_buy,
                'price_sell' => $request->price_sell
            ]);
            
            $success = true;
            $message = 'ອັບເດດຂໍ້ມູນສຳເລັດ !';

        }catch (\Illuminate\Database\QueryException $ex) {

            $success = false;
            $message = $ex->getMessage();

        }
        $respone = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($respone);
  
    }

    public function delete($id){
        try{

            //ເພີ່ມຂໍ້ມູນລົງຕາຕະລາງ
            $store = Store::find($id);
            $store->delete();
            
            $success = true;
            $message = 'ລົບຂໍ້ມູນສຳເລັດ !';

        }catch (\Illuminate\Database\QueryException $ex) {

            $success = false;
            $message = $ex->getMessage();

        }
        $respone = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($respone);
    }
}
