<?php

namespace App\Http\Controllers;

use App\Models\User;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class UserController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:api', ['except' =>['login', 'register']]);
        // $this->middleware('auth:api');
    }

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



    public function login(Request $request){
        $user_login = [
            'email' =>$request->login_email,
            'password' =>$request->login_password

        ];

        $token = JWTAUTH::attempt($user_login);     //ກວດສອບອີເມວ ແລະ ລະຫັດຜ່ານແລ້ວສ້າງ token ຂື້ນມາ
        $user = Auth::user();                       //ຫຼັງຈາກ login ແມ່ນດືງຂໍ້ມູນ user ທີ່  login ອອກມາ


        if ($token) {
            return response()->json([
                'success' => true,
                'message' => 'ສຳເລັດ',
                'user' => $user,
                'token' => $token
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'ອີເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ!'
            ]);
        }
    }

    public function logout(){
        $token = JWTAUTH::getToken();
        $invalidate = JWTAUTH::invalidate($token);

        if ($invalidate) {
            return response()->json([
                'success' => true,
                'message' => 'ສຳເລັດ !'
            ]);
        }
    }

    
}
