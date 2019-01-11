<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\artikels;
use Alert;
use App\kategoriartikels;
class KategoriArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        $kategoriartikels = kategoriartikels::all();
        $filterKeyword = $request->get('nama_kategori');
        
        if($filterKeyword){
            $kategoriartikels = \App\kategoriartikels::where("nama_kategori", "LIKE","%$filterKeyword%")->paginate(10);
        }

        return view('kategoriartikel.index',compact('kategoriartikels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('kategoriartikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
            $this->validate($request,[
            'nama_kategori' => 'required',
            'slug' => '',
           
        ]);

        $kategoriartikels = new kategoriartikels;
        $kategoriartikels->nama_kategori = $request->nama_kategori;
        $kategoriartikels->slug =str_slug($request->nama_kategori,'-');
        $kategoriartikels->save();
        return redirect()->route('kategoriartikel.index')->with('status', 'KategoriArtikel
        Berhasil Ditambahkan!');
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
        $kategoriartikels = kategoriartikels::findOrFail($id);
        return view('kategoriartikel.edit',compact('kategoriartikels'));
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

         $this->validate($request,[
             'nama_kategori' => 'required',
             'slug' => '',

        ]);

        $kategoriartikels = kategoriartikels::findOrFail($id);
        $kategoriartikels->nama_kategori = $request->nama_kategori;
        $kategoriartikels->slug =str_slug($request->nama_kategori,'-');
        $kategoriartikels->save();
        return redirect()->route('kategoriartikel.index')->with('status', 'KategoriArtikel
        Berhasil DiUbah!');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $kategoriartikels = kategoriartikels::findOrFail($id);
        $kategoriartikels->delete();
        return redirect()->route('kategoriartikel.index')->with('status', 'KategoriArtikel
        Berhasil Dihapus!');;;
    }
}