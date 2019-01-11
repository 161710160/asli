<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = \App\Category::paginate(10);
        
        $filterKeyword = $request->get('name');
        
        if($filterKeyword){
            $categories = \App\Category::where("name", "LIKE","%$filterKeyword%")->paginate(10);
        }

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        "name" => "required|unique:categories|min:0|max:20",
        "image" => "required|image|mimes:jpg,png,svg,ico,jpng,jpeg"
        ])->validate();

        $name = $request->get('name');
        
        $new_category = new \App\Category;
        $new_category->name = $request->get('name');
        
        if($request->file('image')){
        
            $image_path = $request->file('image')
                    ->store('category_images', 'public');
            $new_category->image = $image_path;
        }

        $new_category->created_by = \Auth::user()->id;
        
        $new_category->slug = str_slug($name, '-');
        
        $new_category->save();
        
        return redirect()->route('categories.index')->with('status', 'Kategori
        successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = \App\Category::findOrFail($id);

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_to_edit = \App\Category::findOrFail($id);

        return view('categories.edit', ['category' => $category_to_edit]);
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
        "name" => "required|min:0|max:20",
        "image" => "required|image|mimes:jpg,png,svg,ico,jpng,jpeg",
        "slug" => ""]);

        $name = $request->get('name');
        $slug = $request->get('slug');
        
        $category = \App\Category::findOrFail($id);
        
        $category->name = $name;
        $category->slug = $slug;
        
        if($request->file('image')){
        if($category->image && file_exists(storage_path('app/public/' .
        $category->image))){
        \Storage::delete('public/' . $category->name);
        }

        $new_image = $request->file('image')->store('category_images',
        'public');
        $category->image = $new_image;
        }

        $category->updated_by = \Auth::user()->id;
        
        $category->slug = str_slug($name);
        
        $category->save();
        
        return redirect()->route('categories.index', ['id' => $id])->with('status', 'Kategori
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
        $category = \App\Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')
        ->with('status', 'Kategori Berhasil DiHapus!');
}

    

    public function ajaxSearch(Request $request){
    $keyword = $request->get('q');

    $categories = \App\Category::where("name", "LIKE", "%$keyword%")->get();

    return $categories;
    
    }
}
