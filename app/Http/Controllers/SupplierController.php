<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Models\Supplier;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function index(SupplierDataTable $datatable)
    {
        if (auth()->user()->hasRole('superadmin')) {
            $toko = Toko::all();
           
        } else {
            $toko = Toko::where('id', auth()->user()->toko_id)->first();
        }
        return $datatable->render('supplier.index',compact('toko'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|min:3|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'shop_name' => 'required|min:3|max:100',
            'type' => 'nullable|min:3|max:100',
            'account_holder' => 'nullable|min:3|max:100',
            'account_number' => 'nullable|numeric',
            'bank_name' => 'nullable|min:3|max:100',
            'toko_id' => 'required|exists:tokos,id'
        ],[
            'name.required' => 'Name wajib di isi',
            'name.min' => 'Name minimal 3 karakter',
            'name.max' => 'Name maksimal 100 karakter',
            'phone.required' => 'Phone wajib di isi',
            'phone.numeric' => 'Phone harus berupa angka',
            'email.required' => 'Email wajib di isi',
            'email.email' => 'Email harus berupa email',
            'address.required' => 'Address wajib di isi',
            'address.min' => 'Address minimal 3 karakter',
            'address.max' => 'Address maksimal 100 karakter',
            'photo.image' => 'Photo harus berupa gambar',
            'photo.mimes' => 'Photo harus berupa jpeg,png,jpg,gif,svg',
            'photo.max' => 'Photo maksimal 2048',
            'shop_name.required' => 'Shop Name wajib di isi',
            'shop_name.min' => 'Shop Name minimal 3 karakter',
            'shop_name.max' => 'Shop Name maksimal 100 karakter',
            'type.min' => 'Type minimal 3 karakter',
            'type.max' => 'Type maksimal 100 karakter',
            'account_holder.min' => 'Account Holder minimal 3 karakter',
            'account_holder.max' => 'Account Holder maksimal 100 karakter',
            'account_number.numeric' => 'Account Number harus berupa angka',
            'bank_name.min' => 'Bank Name minimal 3 karakter',
            'bank_name.max' => 'Bank Name maksimal 100 karakter',
            'toko_id.required' => 'Toko Id wajib di isi',
            'toko_id.exists' => 'Toko Id tidak ditemukan'


           
        ]);
        $request->merge(['uuid' => Str::uuid()]);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/supplier'), $photo_name);
            $request->merge(['name_photo' => $photo_name]);
        }
        $request->except(['photo']);
        Supplier::create([
            'toko_id' => $request->toko_id,
            'uuid' => $request->uuid,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'photo' => $request->name_photo,
            'shop_name' => $request->shop_name,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name
        ]);

        return response()->json(['success' => true, 'message' => 'Supplier created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['success' => false, 'message' => 'Supplier not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $supplier, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|min:3|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'shop_name' => 'required|min:3|max:100',
            'type' => 'nullable|min:3|max:100',
            'account_holder' => 'nullable|min:3|max:100',
            'account_number' => 'nullable|numeric',
            'bank_name' => 'nullable|min:3|max:100',
            'toko_id' => 'required|exists:tokos,id'
        ],[
            'name.required' => 'Name wajib di isi',
            'name.min' => 'Name minimal 3 karakter',
            'name.max' => 'Name maksimal 100 karakter',
            'phone.required' => 'Phone wajib di isi',
            'phone.numeric' => 'Phone harus berupa angka',
            'email.required' => 'Email wajib di isi',
            'email.email' => 'Email harus berupa email',
            'address.required' => 'Address wajib di isi',
            'address.min' => 'Address minimal 3 karakter',
            'address.max' => 'Address maksimal 100 karakter',
            'photo.image' => 'Photo harus berupa gambar',
            'photo.mimes' => 'Photo harus berupa jpeg,png,jpg,gif,svg',
            'photo.max' => 'Photo maksimal 2048',
            'shop_name.required' => 'Shop Name wajib di isi',
            'shop_name.min' => 'Shop Name minimal 3 karakter',
            'shop_name.max' => 'Shop Name maksimal 100 karakter',
            'type.min' => 'Type minimal 3 karakter',
            'type.max' => 'Type maksimal 100 karakter',
            'account_holder.min' => 'Account Holder minimal 3 karakter',
            'account_holder.max' => 'Account Holder maksimal 100 karakter',
            'account_number.numeric' => 'Account Number harus berupa angka',
            'bank_name.min' => 'Bank Name minimal 3 karakter',
            'bank_name.max' => 'Bank Name maksimal 100 karakter',
            'toko_id.required' => 'Toko Id wajib di isi',
            'toko_id.exists' => 'Toko Id tidak ditemukan'


           
        ]);
        $request->merge(['uuid' => Str::uuid()]);
        if ($request->hasFile('photo')) {
            $supplier = Supplier::find($id);
            if ($supplier->photo) {
                unlink(public_path('upload/supplier/' . $supplier->photo));
            }

            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/supplier'), $photo_name);
            $request->merge(['name_photo' => $photo_name]);
        }
        $request->except(['photo']);

        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['success' => false, 'message' => 'Supplier not found'], 404);
        }

        $update = [
            'toko_id' => $request->toko_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'photo' => $request->name_photo,
            'shop_name' => $request->shop_name,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name
        ];

        $supplier->update($update);

        return response()->json(['success' => true, 'message' => 'Supplier update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['success' => true, 'message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['success' => true, 'message' => 'Supplier deleted successfully', '_token' => csrf_token()]);
    }
}
