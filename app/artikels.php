<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artikels extends Model
{
    protected $table='artikels';

    protected $fillable=['id_kategoriartikels','judul','gambar','deskripsi','publish'];

    public $timestamps= true;

    public function kategoriartikels()
    {
        return $this->belongsTo('App\kategoriartikels','id_kategoriartikels');
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
