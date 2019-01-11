<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Produk;
use App\Category;
class ProdukController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $status = $request->get('categories');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        if($status){
        $produks = Produk::with('categories')->where('title', "LIKE",
        "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
        $produks = Produk::with('categories')->where("title", "LIKE",
        "%$keyword%")->paginate(10);
        }
        $filterKeyword = $request->get('title');
        
        if($filterKeyword){
            $produks = \App\Produk::where("title", "LIKE","%$filterKeyword%")->paginate(10);
        }

        return view('produks.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::all();
        $categories = Category::all();
        return view('produks.create',compact('produk', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
        "title" => "required|min:0|max:200",
        "description" => "required|min:0|max:1000",
        "price" => "required|digits_between:0,20",
        "stock" => "required|digits_between:0,20",
        "cover" => "required|image|mimes:jpg,png,svg,ico,jpng,jpeg",
        'id_categories' => 'required',
        ])->validate();
        $new_produk = new \App\Produk;
        $new_produk->title = $request->get('title');
        $new_produk->description = $request->get('description');
        $new_produk->id_categories = $request->get('id_categories');
        $new_produk->price = $request->get('price');
        $new_produk->stock = $request->get('stock');
        $new_produk->status = $request->get('save_action');
        $new_produk->slug = str_slug($request->get('title'));
        $new_produk->created_by = \Auth::user()->id;
        $cover = $request->file('cover');
        if($cover){
        $cover_path = $cover->store('produk-covers', 'public');
        $new_produk->cover = $cover_path;
        }
        $new_produk->save();
        if($request->get('save_action') == 'PUBLISH'){
        return redirect()
        ->route('produks.index')
        ->with('status', 'produk successfully saved and published');
        } else {
        return redirect()->route('produks.index')
        ->with('status', 'Barang
        Berhasil DiTambahkan!');
        }
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
        $produk = Produk::findOrFail($id);
        $categories = Category::all();
        $selectedkategori = Produk::findOrFail($produk->id)->id_categories;
        return view('produks.edit',compact('produk','categories','selectedkategori'));
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
        \Validator::make($request->all(), [
        "title" => "required|min:0|max:200",
        "description" => "required|min:0|max:1000",
        "price" => "required|digits_between:0,10",
        "stock" => "required|digits_between:0,10",
        "cover" => "required|image|mimes:jpg,png,svg,ico,jpng,jpeg",
        'id_categories' => 'required',
        ])->validate();

        $produk = \App\Produk::findOrFail($id);

        $produk->title = $request->get('title');
        $produk->slug = $request->get('slug');
        $produk->description = $request->get('description');
        $produk->id_categories = $request->get('id_categories');
        $produk->stock = $request->get('stock');
        $produk->price = $request->get('price');

        $new_cover = $request->file('cover');
        if($new_cover){
        if($produk->cover && file_exists(storage_path('app/public/' . $produk->cover))){
        \Storage::delete('public/'. $produk->cover);
    }

        $new_cover_path = $new_cover->store('produk-covers', 'public');

        $produk->cover = $new_cover_path;
    }
        $produk->updated_by = \Auth::user()->id;

        $produk->status = $request->get('status');

        $produk->save();


        return redirect()->route('produks.index', ['id'=>$produk->id])->with('status', 'Barang
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
        $produk = \App\Produk::findOrFail($id);
        $produk->delete();
    
        return redirect()->route('produks.index')->with('status', 'Barang
        Berhasil Dihapus!');;
    }

    public function trash()
    {
        $produks = \App\Produk::onlyTrashed()->paginate(10);
        return view('produks.trash', ['produks' => $produks]);
    }

    public function restore($id){
    $produk = \App\Produk::withTrashed()->findOrFail($id);
    if($produk->trashed()){
    $produk->restore();
    return redirect()->route('produks.trash')->with('status', 'produk successfully restored');
    } else {
    return redirect()->route('produks.trash')->with('status', 'produk is not in
    trash');
    }
}
}


