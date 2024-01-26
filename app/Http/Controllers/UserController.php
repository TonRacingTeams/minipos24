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

                //ກວດສອບອີເມວບໍ່ໃຫ້ຊ້ຳກັນ

                $check_email = User::where('email', $request->from_email);

                if ($check_email->count()) {
                    # code...

                    $success = false;
                    $message = 'ອີເມວ : '.$request->from_email. ' ໄດ້ຖືກລົງທະບຽນແລ້ວ !';
                }else{
                    $user = new User([
                        'name' => $request->from_user_name,
                        'last_name' => $request->from_last_name,
                        'gender' => $request->from_gender,
                        'email' => $request->from_email,
                        'password' => $request->from_password,
                    ]);
    
                    $user->save();
                    $success = true;
                    $message = 'ບັນທຶກສຳເລັດ!';
                }

                

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
