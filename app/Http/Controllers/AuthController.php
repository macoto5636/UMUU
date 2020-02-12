<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    function login(){
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
 
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'ログアウトしました。']);
    }
 
    public function me()
    {
        return response()->json(auth()->user());
    }
 
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("api")->factory()->getTTL() * 60
        ]);
    }

    //入力されたメールアドレスが存在しているかどうか
    public function forget(Request $request){

        return var_export(DB::table('users')->where('email', $request->email)->exists());
        
    }

    //パスワード再設定
    public function passUpdate(Request $request){
        
        DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => password_hash($request->password, PASSWORD_DEFAULT)]);
        return  password_hash($request->password, PASSWORD_DEFAULT);
    }


    //ユーザ情報を変更
    public function userChange(Request $request){
        $user = \App\User::find($request->id);
        $user-> email = request('email');
        $user-> first_name = request('first_name');
        $user-> last_name = request('last_name');
        $user-> kana_first_name = request('kana_first_name');
        $user-> kana_last_name = request('kana_last_name');
        $user-> postalcode = request('postalcode');
        $user-> prefecture = request('prefecture');
        $user-> adress = request('adress');

        $user-> save();
    }
}