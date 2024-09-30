<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\Product;
use App\Models\Toko;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(ProductDataTable $datatable)
    {
        
        if(auth()->user()->hasRole('superadmin')){
            $toko = Toko::all();
            if(request()->has('toko_id')){
                $category = Category::where('toko_id', request('toko_id'))->get();
                $unit = Unit::where('toko_id', request('toko_id'))->get();
            }else{
                $category = Category::all();
                $unit = Unit::all();
            }
        }else{
            $toko = Toko::where('id', auth()->user()->toko_id)->first();
            $category = Category::where('toko_id', auth()->user()->toko_id)->get();
            $unit = Unit::where('toko_id', auth()->user()->toko_id)->get();
        }
        return $datatable->render('product.index',compact('toko','category','unit'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|min:3|max:100',
            'slug' => 'required|min:3|max:100',
            'code' => 'required|numeric',
            'quantity' => 'required|numeric',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'tax' => 'required|numeric',
            'notes' => 'required|min:3|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'unit_id' => 'required|exists:units,id',
            'toko_id' => 'required|exists:tokos,id' 
        ],[
            'category_id.required' => 'Category wajib diisi',
            'category_id.exists' => 'Category tidak ditemukan',
            'name.required' => 'Nama product wajib diisi',
            'name.min' => 'Nama product minimal 3 karakter',
            'name.max' => 'Nama product maksimal 100 karakter',
            'slug.required' => 'Slug wajib diisi',
            'slug.min' => 'Slug minimal 3 karakter',
            'slug.max' => 'Slug maksimal 100 karakter',
            'code.required' => 'Code wajib diisi',
            'code.numeric' => 'Code harus berupa angka',
            'quantity.required' => 'Quantity wajib diisi',
            'quantity.numeric' => 'Quantity harus berupa angka',
            'buying_price.required' => 'Buying price wajib diisi',
            'buying_price.numeric' => 'Buying price harus berupa angka',
            'selling_price.required' => 'Selling price wajib diisi',
            'selling_price.numeric' => 'Selling price harus berupa angka',
            'tax.required' => 'Tax wajib diisi',
            'tax.numeric' => 'Tax harus berupa angka',
            'notes.required' => 'Notes wajib diisi',
            'notes.min' => 'Notes minimal 3 karakter',
            'notes.max' => 'Notes maksimal 100 karakter',
            'image.required' => 'Image wajib diisi',
            'image.image' => 'Image harus berupa gambar',
            'image.mimes' => 'Image harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'image.max' => 'Image maksimal 2MB',
            'unit_id.required' => 'Unit wajib diisi',
            'unit_id.exists' => 'Unit tidak ditemukan',
            'toko_id.required' => 'Toko wajib diisi',
            'toko_id.exists' => 'Toko tidak ditemukan'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $uuid = Str::uuid()->toString();

        Product::create([
            'uuid' => $uuid,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'tax' => $request->tax,
            'notes' => $request->notes,
            'image' => $name,
            'unit_id' => $request->unit_id,
            'toko_id' => $request->toko_id
        ]);

        return response()->json(['success' => true, 'message' => 'Product created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $product, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|min:3|max:100',
            'slug' => 'required|min:3|max:100',
            'code' => 'required|numeric',
            'quantity' => 'required|numeric',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'tax' => 'required|numeric',
            'notes' => 'required|min:3|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'unit_id' => 'required|exists:units,id',
            'toko_id' => 'required|exists:tokos,id' 
        ],[
            'category_id.required' => 'Category wajib diisi',
            'category_id.exists' => 'Category tidak ditemukan',
            'name.required' => 'Nama product wajib diisi',
            'name.min' => 'Nama product minimal 3 karakter',
            'name.max' => 'Nama product maksimal 100 karakter',
            'slug.required' => 'Slug wajib diisi',
            'slug.min' => 'Slug minimal 3 karakter',
            'slug.max' => 'Slug maksimal 100 karakter',
            'code.required' => 'Code wajib diisi',
            'code.numeric' => 'Code harus berupa angka',
            'quantity.required' => 'Quantity wajib diisi',
            'quantity.numeric' => 'Quantity harus berupa angka',
            'buying_price.required' => 'Buying price wajib diisi',
            'buying_price.numeric' => 'Buying price harus berupa angka',
            'selling_price.required' => 'Selling price wajib diisi',
            'selling_price.numeric' => 'Selling price harus berupa angka',
            'tax.required' => 'Tax wajib diisi',
            'tax.numeric' => 'Tax harus berupa angka',
            'notes.required' => 'Notes wajib diisi',
            'notes.min' => 'Notes minimal 3 karakter',
            'notes.max' => 'Notes maksimal 100 karakter',
            'image.required' => 'Image wajib diisi',
            'image.image' => 'Image harus berupa gambar',
            'image.mimes' => 'Image harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'image.max' => 'Image maksimal 2MB',
            'unit_id.required' => 'Unit wajib diisi',
            'unit_id.exists' => 'Unit tidak ditemukan',
            'toko_id.required' => 'Toko wajib diisi',
            'toko_id.exists' => 'Toko tidak ditemukan'
        ]);

        // handle image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        
        }
        $product = Product::find($id)->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'tax' => $request->tax,
            'notes' => $request->notes,
            'image' => $name,
            'unit_id' => $request->unit_id,
            'toko_id' => $request->toko_id
        ]);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $update = $request->all();

        $product->update($update);

        return response()->json(['success' => true, 'message' => 'Product update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => true, 'message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product deleted successfully', '_token' => csrf_token()]);
    }
}
