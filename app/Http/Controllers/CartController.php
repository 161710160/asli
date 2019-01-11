<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use App\Produk;
use App\carts;
use App\User;
use File;
use Alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts =carts::all();
        return view('carts.index',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = carts::all();
        $produks = Produk::all();
        $users = User::all();
        return view('carts.create',compact('carts', 'produks','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Alert::success('Data Successfully Saved','Good Job!')->autoclose(1700);

        $this->validate($request,[
            'subtotal' => '',
            'id_produks' => 'required',
            'jumlah' => 'required',
            'id_users' => 'required',

           
        ]);

        $carts = new carts;
            $carts->subtotal = $request->subtotal;
            $carts->jumlah = $request->jumlah;
            $carts->id_users = $request->id_users;   
            $carts->id_produks = $request->id_produks;

            $produks = Produk::findorFail($carts->id_produks);
            $carts->subtotal = $request->jumlah * $produks->price;

            $carts->save();
        return redirect()->route('carts.index')->with('status', 'Cart
        Berhasil Ditambahkan!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carts = carts::findOrFail($id);
        $users = User::all();
        $produks = Produk::all();
        $selecteduser = carts::findOrFail($carts->id)->id_users;
        $selectedproduk = carts::findOrFail($carts->id)->id_produks;
        return view('carts.edit',compact('carts','produks','selectedproduk','selecteduser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Alert::success('Data Successfully Changed','Good Job!')->autoclose(1700);

        $this->validate($request,[
             'subtotal' => '',
             'jumlah' => 'required',
             'id_users' => 'required',
             'id_produks' => 'required',

        ]);

        $carts = carts::findOrFail($id);
            $carts->subtotal = $request->subtotal;
            $carts->jumlah = $request->jumlah;
            $carts->id_produks = $request->id_produks;
            $carts->id_users = $request->id_users;

            $produks = Produk::findorFail($carts->id_produks);
            $carts->subtotal = $request->jumlah = $produks->price;

            $carts->save();
        return redirect()->route('carts.index')->with('status', 'Cart
        Berhasil DiUbah!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alert::success('Data Successfully Deleted','Good Job!')->autoclose(1700);
        
        $carts = carts::findOrFail($id);
        $carts->delete();
        return redirect()->route('carts.index')->with('status', 'Artikel
        Berhasil Dihapus!');;
    }
}
