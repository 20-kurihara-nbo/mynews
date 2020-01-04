<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');//
    
    public static $rules = array(
        'name' => 'required',
        'hobby' => 'string',
        'introduction' => 'string',
    );
    
    //profileeditモデルに関連付けを行う
    public function profileedit()
    {
        return $this->hasmany('App\profileedit');
    }
}
