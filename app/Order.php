<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\users;
use App\produks;
class Order extends Model
{
    public function user(){
	
	return $this->belongsTo('App\User');
	}

	public function produks(){

	return $this->belongsToMany('App\Produk')->withPivot('quantity');;
	}

	public function getTotalQuantityAttribute(){
	$total_quantity = 0;

	foreach($this->produks as $produk){
		$total_quantity += $produk->pivot->quantity;
	}
	
	return $total_quantity;
	}
}
