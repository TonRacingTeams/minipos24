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

        $stort = \Request::get('sort');
        $perpage = \Request::get('perpage');
        $search = \Request::get('search');

        $store = Store::orderBy('id',$stort)

        // ການຄົ້ນຫາຂໍ້ມູນໃນຟິວດຽວ Colunm
        // ->where('name','LIKE',"%{$search}%")



        // ການຄົ້ນຫາຂໍ້ມູນໃນຫຼາຍຟິວພ້ອມກັນ Colunms
        ->where(
            function($query) use ($search){
                $query->where('name','LIKE',"%{$search}%")
                ->orWhere('price_buy','LIKE',"%{$search}%")
                ->orWhere('price_sell','LIKE',"%{$search}%");
            }
        )
        ->paginate($perpage)
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
