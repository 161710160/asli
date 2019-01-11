<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Order;
use App\Produk;
use App\User;
use App\checkouts;
use App\carts;
use App\artikels;
use App\kategoriartikels;


class FrontendController extends Controller
{
    public function index ()
    {
    	return view('frontends.index');
    }

    public function artikels ()
    {
    	$artikels = artikels::orderBy('created_at','DESC')->paginate(6);
    	return view('frontends.blog', compact('artikels'));
    }
    public function filter_artikels($id)
    {
        $kategoripartikel = artikels::where('kategoriartikel_id','=',$id)->get();
        return view('frontends.blog', compact('kategoripartikel'));
    }
    public function galeris ()
    {
    	$galeris = galeris::all();
    	return view('frontends.galeri', compact('galeris'));
    }
    public function testimonis ()
    {
    	$testimonis = testimonis::all();
    	return view('frontends.testimoni', compact('testimonis'));
    }
    public function cart ()
    {
    	$carts = carts::all();
    	return view('frontends.cart', compact('carts'));
    }
    public function category ()
    {
    	$category = Category::all();
    	return view('frontends.shop', compact('category'));
    }
    public function kategoriartikels ()
    {
    	$kategoriartikels = kategoriartikels::all();
    	return view('frontends.blog', compact('kategoriartikels'));
    }

    public function produks()
    {
        $categorip = Produk::orderBy('created_at','DESC')->paginate(6);
        return view('frontends.shop',compact('categorip'));
    }
    public function filter_produks($id)
    {
        $categorip = Produk::where('kategori_id','=',$id)->get();
        return view('frontends.shop', compact('categorip'));
    }

    public function single(artikels $artikels)
    {
    
    return view('frontends.blogdetails',compact('artikels'));
    }
    
    public function singleproduk(barangs $barangs)
    {
    
    return view('frontends.singleproduk',compact('barangs'));
    }
    public function storeCheck(Request $request)
    {
        Alert::success('Data Successfully Saved','Good Job!')->autoclose(1700);

        $this->validate($request,[
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'telephone' => 'required',
            'alamat_satu' => 'required|min:2',
            'alamat_dua' => 'required',
            'negara' => 'required',
            'kota' => 'required',
            'daerah' => 'required',
            'kode_pos' => 'required',

           
        ]);

        $checkouts = new checkouts;   
            $checkouts->nama_depan = $request->nama_depan;
            $checkouts->nama_belakang = $request->nama_belakang;   
            $checkouts->telephone = $request->telephone;
            $checkouts->alamat_satu = $request->alamat_satu;
            $checkouts->alamat_dua = $request->alamat_dua;   
            $checkouts->negara = $request->negara;
            $checkouts->kota = $request->kota;
            $checkouts->daerah = $request->daerah;
            $checkouts->kode_pos = $request->kode_pos;
            $checkouts->save();
        return redirect()->route('confirmation.index');
    }
}

