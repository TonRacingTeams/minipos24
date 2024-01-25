<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function register(Request $request){
            try{

                $user = new User([
                    'name' => $request->from_user_name,
                    'email' => $request->from_email,
                    'password' => $request->from_password,
                ]);

                $user->save();
                $success = true;
                $message = 'ບັນທຶກສຳເລັດ!';

            }catch (\Illuminate\Database\QueryException $ex) {

                $success = false;
                $message = $ex->getMessage();

            }

            $response = [
                'success' => $success,
                'message' => $message
            ];

            return response()->json($response);
    }
}
