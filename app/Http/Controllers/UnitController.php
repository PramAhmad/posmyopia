<?php

namespace App\Http\Controllers;

use App\DataTables\UnitDataTable;
use App\Models\Toko;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UnitController extends Controller
{
    public function index(UnitDataTable $datatable)
    {
        if(auth()->user()->hasRole('superadmin')){
            $toko = Toko::all();
        }else{
            $toko = Toko::where('id', auth()->user()->toko_id)->get();
        }
        return $datatable->render('unit.index',compact('toko'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'toko_id' => 'required|exists:tokos,id',
            'name' => 'required|min:3|max:100',
            'slug' => 'required|min:3|max:100',
            'short_code' => 'required|min:1|max:10'
        ],[
            'toko_id.required' => 'Toko wajib diisi',
            'toko_id.exists' => 'Toko tidak ditemukan',
            'name.required' => 'Nama unit wajib diisi',
            'name.min' => 'Nama unit minimal 3 karakter',
            'name.max' => 'Nama unit maksimal 100 karakter',
            'slug.required' => 'Slug wajib diisi',
            'slug.min' => 'Slug minimal 3 karakter',
            'slug.max' => 'Slug maksimal 100 karakter',
            'short_code.required' => 'Kode singkat wajib diisi',
            'short_code.min' => 'Kode singkat minimal 1 karakter',
            'short_code.max' => 'Kode singkat maksimal 10 karakter'
        ]);

        Unit::create($request->all());

        return response()->json(['success' => true, 'message' => 'Unit created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json(['success' => false, 'message' => 'Unit not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $unit, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'toko_id' => 'required|exists:tokos,id',
            'name' => 'required|min:3|max:100',
            'slug' => 'required|min:3|max:100',
            'short_code' => 'required|min:1|max:10'
        ],[
            'toko_id.required' => 'Toko wajib diisi',
            'toko_id.exists' => 'Toko tidak ditemukan',
            'name.required' => 'Nama unit wajib diisi',
            'name.min' => 'Nama unit minimal 3 karakter',
            'name.max' => 'Nama unit maksimal 100 karakter',
            'slug.required' => 'Slug wajib diisi',
            'slug.min' => 'Slug minimal 3 karakter',
            'slug.max' => 'Slug maksimal 100 karakter',
            'short_code.required' => 'Kode singkat wajib diisi',
            'short_code.min' => 'Kode singkat minimal 1 karakter',
            'short_code.max' => 'Kode singkat maksimal 10 karakter'
        ]);

        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json(['success' => false, 'message' => 'Unit not found'], 404);
        }

        $update = $request->all();

        $unit->update($update);

        return response()->json(['success' => true, 'message' => 'Unit update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json(['success' => true, 'message' => 'Unit not found'], 404);
        }

        $unit->delete();

        return response()->json(['success' => true, 'message' => 'Unit deleted successfully', '_token' => csrf_token()]);
    }
}
