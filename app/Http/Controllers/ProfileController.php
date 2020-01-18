<?php

//名前空間を宣言
namespace App\Http\Controllers;

//Requestをインポート
use Illuminate\Http\Request;
//HTMLをインポート
use Illuminate\Support\Facades\HTML;
//Profileをインポート
use App\Profile;

//ControllerクラスをProfileControllerクラスに継承
class ProfileController extends Controller
{
    //index Actionを作成
    public function index(Request $request)
    {
        //データベースのProfilesから情報を取得
         //Profile　Modelからデータを取得する。
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
            }
        
        //profile/index.blade.phpファイルを渡している
        //またviewテンプレートに$profileという変数を渡している
        return view('profile.index', ['profile_form' => $profile]);
    }
}
