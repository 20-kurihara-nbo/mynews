<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//以下によりProfile Modelを扱えるように設定
use App\Profile;

//profileedit modelの使用を宣言
use App\profileedit;

//carbonの使用を宣言
use carbon\carbon;

class ProfileController extends Controller
{
    //laravel08 コントローラーとルーティング　課題５
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        //Validationを行う
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
      //該当するデータをprofileeditモデルへ送信
      $profileedit=new profileedit;
      $profileedit->profile_id = $Profile->id;
      $profileedit->edited_at = Carbon::now();
      $profileedit->save();
      
      
        return redirect('admin/profile/edit');
    }
}
