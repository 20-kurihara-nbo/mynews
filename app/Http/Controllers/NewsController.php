<?php

//名前空間を宣言
namespace App\Http\Controllers;

//Requestをインポート
use Illuminate\Http\Request;
//HTMLをインポート
use Illuminate\Support\Facades\HTML;
//Newsをインポート
use App\News;

//ControllerクラスをNewsControllerクラスに継承
class NewsController extends Controller
{
    //indexメソッドをオーバーライド
    public function index(Request $request)
    {
        $posts = News::all()->sortByDesc('updated_at');
        
        if(count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        
        // news/index.blade.phpファイルを渡している
        // またviewテンプレートにheadline,posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
