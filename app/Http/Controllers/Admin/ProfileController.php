<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//以下を追記することでProfile Modelが扱えるようになる
use App\Profile;
use App\ProfileHistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        
        // Varidationを行う
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
        
    }
    
 // 以下、edit Acttion追加
    
    public function edit (Request $request)
    {
    // Profile modelからデータを取得する
    $profile = Profile::find($request->id);
    if (empty($profile)) {
        abort(404);
    }
    return view('admin.profile.edit',['profile_form' => $profile]);
    }
 
 // 以下、update Acttion追加 
    
    public function update(Request $request)
    {
    // Validationをかける
    $this->validate($request, Profile::$rules);
    // Profile modelからデータを取得する
    $profile = Profile::find($request->id);
    // 送信されてきたフォームデータを格納する
    $profile_form = $request->all();
    unset($profile_form['_token']);
    
    // 該当するデータを上書きして保存する
    $profile->fill($profile_form)->save();
    
    // Profile Modelを保存するタイミングで、同時に ProfileHistory Modelにも編集履歴を追加
    $history = new ProfileHistory;
    $history->profile_id = $profile->id;
    $history->edited_at = Carbon::now();
    $history->save();    
    
        return redirect('admin/profile/create');
    }
}
