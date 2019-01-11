<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkouts extends Model
{
    protected $table='checkouts';

    protected $fillable=['nama_depan','nama_belakang','telephone','alamat_satu','alamat_dua','negara','kota','daerah','kode_pos'];

    public $timestamps= true;
}
