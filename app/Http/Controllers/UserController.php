<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function register(Request $request){
            try {
                $user = new User([
                    'name' => $request->from_user_name,
                    'email' => $request->from_email,
                    'password' => hash::make($request->from_password)
                ]);

                $user->save();
                $succes = true;
                $message = 'ບັນທຶກສຳເລັດ !';

            } catch (\Illuminate\Database\QueryException $ex) {
                //throw $th;
                $succes = false;
                $message = $ex->getMessage();
            }

            $response = [
                'success' => $succes,
                'message' => $message
            ];
            return response()->json($response);
    }
}
