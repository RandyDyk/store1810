<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table='user';
    protected $primarykey='user_id';
    public $timestamps=false;
}
