<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table= 'categories';
    
    public $timestamps= true;

    public function produks()
    {
        return $this->hasOne('App\Produk','id_produks');
    }
}
