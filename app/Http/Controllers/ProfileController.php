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
        $posts = Profiles::all()->sortByDesc('update_at');
        
        if(count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        
        //profile/index.blade.phpファイルを渡している
        //またviewテンプレートにheadline,posts、という変数を渡している
        return view('profile.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
