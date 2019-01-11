<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use App\categories;
use App\checkouts;
use File;
use Alert;

class CheckoutController extends Controller
{
    
    public function index(Request $request)
    {
        $checkouts =checkouts::all();
        $filterKeyword = $request->get('nama_depan');
        
        if($filterKeyword){
            $checkouts = \App\checkouts::where("nama_depan", "LIKE","%$filterKeyword%")->paginate(10);
        }

        return view('checkout.index',compact('checkouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checkouts = checkouts::all();
        return view('checkout.create',compact('checkouts'));
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
        return redirect()->route('checkout.index')->with('status', 'Checkout
        Berhasil DiTambahkan!');
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
        $checkouts = checkouts::findOrFail($id);
        return view('checkout.edit',compact('checkouts'));
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

        $checkouts = checkouts::findOrFail($id);
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
        return redirect()->route('checkout.index')->with('status', 'Checkout
        Berhasil DiUbah!');
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
        
        $checkouts = checkouts::findOrFail($id);
        $checkouts->delete();
        return redirect()->route('checkout.index')->with('status', 'Checkout
        Berhasil Dihapus!');
    }
}
