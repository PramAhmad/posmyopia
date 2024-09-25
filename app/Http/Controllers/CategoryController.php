<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $datatable)
    {
        if(auth()->user()->hasRole('superadmin')){
            $toko = Toko::all();
        }else{
            $toko = Toko::where('id', auth()->user()->toko_id)->get();
        }
        return $datatable->render('category.index',compact('toko'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
           'toko_id' => 'required',
              'name' => 'required|min:3|max:100',
              'slug' => 'required|min:3|max:100'
        ],[
            'toko_id.required' => 'Toko wajib diisi',
            'name.required' => 'Nama kategori wajib diisi',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.max' => 'Nama kategori maksimal 100 karakter',
            'slug.required' => 'Slug wajib diisi',
            'slug.min' => 'Slug minimal 3 karakter',
            'slug.max' => 'Slug maksimal 100 karakter'
        ]);

        Category::create($request->all());

        return response()->json(['success' => true, 'message' => 'Category created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $category, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'toko_id' => 'required',
            'name' => 'required|min:3|max:100',
            'slug' => 'required|min:3|max:100'
        ],[
            'toko_id.required' => 'Toko wajib diisi',
            'name.required' => 'Nama kategori wajib diisi',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.max' => 'Nama kategori maksimal 100 karakter',
            'slug.required' => 'Slug wajib diisi',
            'slug.min' => 'Slug minimal 3 karakter',
            'slug.max' => 'Slug maksimal 100 karakter'
        ]);
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        $update = $request->all();

        $category->update($update);

        return response()->json(['success' => true, 'message' => 'Category update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['success' => true, 'message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted successfully', '_token' => csrf_token()]);
    }
}
