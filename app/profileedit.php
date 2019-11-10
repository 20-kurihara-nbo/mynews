<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profileedit extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'profile_id' => 'repuired',
        'edited_at' => 'repuired',
        );
}
