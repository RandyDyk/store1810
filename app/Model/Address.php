<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table='address';
    protected $primarykey='address_id';
    public $timestamps=false;
}
