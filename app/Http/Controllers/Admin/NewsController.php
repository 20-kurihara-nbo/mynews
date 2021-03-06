<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;

use App\History;

use Carbon\Carbon;

class NewsController extends Controller
{
    public function add()
    {
        return view('admin.news.create');
    }
        
    public function create(Request $request)
    {
        $this->validate($request, News::$rules);
        
        $news = new News;
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して、$news->image_pathに画像のパスを保存する。
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        //データベースに保存する
        $news->fill($form);
        $news->save();
        
        
        // admin/news/createにリダイレクトする
        return redirect('admin/news/create');
    }
    
    //アクセス制限なしのユーザ定義関数index
    public function index(Request $request)
    {
        //$requestの中のcond_titleの値を代入。$requestに値がなければnull
        $cond_title = $request->cond_title;
        //もし$cond_titleがnull出ないなら
        if ($cond_title !=''){
            //検索されたら検索結果を取得して代入。入力した文字に一致するレコードを全て取得。
            $posts=News::where('title', $cond_title)->get();
        } else {
            //それ以外は全てのニュースを取得する
            $posts=News::all();
        }
        //Requestにcond_titleを送っている
        return view('admin.news.index', ['posts' => $posts,'cond_title'=>$cond_title]);
        
    }
    //editアクションを追加する。編集画面です。
    public function edit(Request $request)
    {
        //News　Modelからデータを取得する。
        $news = News::find($request->id);
        if (empty($news)) {
            abort(404);
        }
        return view('admin.news.edit', ['news_form' => $news]);
    }
    
    //update Actionを追加。編集画面から送信されたフォームデータを処理する。
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request, News::$rules);
        //News Modelからデータを取得する
        $news = News::find($request->id);
        //送信されてきたフォームデータを格納する
        $news_form = $request->all();
        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }
        unset($news_form['_token']);
        unset($news_form['image']);
        unset($news_form['remove']);
        
        //該当するデータを上書きして保存する
        $news->fill($news_form)->save();
        
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('admin/news/');
    }
    
    //削除アクションをコントローラーに追加
    public function delete(Request $request)
    {
        //該当するニュースモデルを取得
        $news = News::find($request->id);
        //削除する
        $news->delete();
        return redirect('admin/news/');
    }
}
    
