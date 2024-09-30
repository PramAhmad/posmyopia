<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Models\Customer;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class CustomerController extends Controller
{
    public function index(CustomerDataTable $datatable)
    {
        if (auth()->user()->hasRole('superadmin')) {
            $toko = Toko::all();
        } else {
            $toko = Toko::where('id', auth()->user()->toko_id)->first();
        }
        return $datatable->render('customer.index',compact('toko'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'toko_id' => 'required|exists:tokos,id',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|min:3|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'account_holder' => 'nullable|min:3|max:100',
            'account_number' => 'nullable|numeric',
            'bank_name' => 'nullable|min:3|max:100'
        ],[
            'name.required' => 'Name wajib di isi',
            'name.min' => 'Name minimal 3 karakter',
            'name.max' => 'Name maksimal 100 karakter',
            'toko_id.required' => 'Toko wajib di isi',
            'toko_id.exists' => 'Toko tidak ditemukan',
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
            'account_holder.min' => 'Account Holder minimal 3 karakter',
            'account_holder.max' => 'Account Holder maksimal 100 karakter',
            'account_number.numeric' => 'Account Number harus berupa angka',
            'bank_name.min' => 'Bank Name minimal 3 karakter',
            'bank_name.max' => 'Bank Name maksimal 100 karakter'
        ]);
        $request->merge(['uuid' => Str::uuid()]);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/customer'), $photo_name);
            $request->merge(['name_photo' => $photo_name]);
        }
        $request->except(['photo']);
        Customer::create([
            'toko_id' => $request->toko_id,
            'uuid' => $request->uuid,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'photo' => $request->name_photo,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name
        ]);

        return response()->json(['success' => true, 'message' => 'Customer created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $customer, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'toko_id' => 'required|exists:tokos,id',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|min:3|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'account_holder' => 'nullable|min:3|max:100',
            'account_number' => 'nullable|numeric',
            'bank_name' => 'nullable|min:3|max:100'
        ],[
            'name.required' => 'Name wajib di isi',
            'name.min' => 'Name minimal 3 karakter',
            'name.max' => 'Name maksimal 100 karakter',
            'toko_id.required' => 'Toko wajib di isi',
            'toko_id.exists' => 'Toko tidak ditemukan',
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
            'account_holder.min' => 'Account Holder minimal 3 karakter',
            'account_holder.max' => 'Account Holder maksimal 100 karakter',
            'account_number.numeric' => 'Account Number harus berupa angka',
            'bank_name.min' => 'Bank Name minimal 3 karakter',
            'bank_name.max' => 'Bank Name maksimal 100 karakter'
        ]);

        $request->merge(['uuid' => Str::uuid()]);
        if ($request->hasFile('photo')) {
            $customer = Customer::find($id);
            if ($customer->photo) {
                unlink(public_path('upload/customer/' . $customer->photo));
            }

            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/customer'), $photo_name);
            $request->merge(['name_photo' => $photo_name]);
        }
        $request->except(['photo']);

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        $update = $request->all();

        $customer->update($update);

        return response()->json(['success' => true, 'message' => 'Customer update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['success' => true, 'message' => 'Customer not found'], 404);
        }

        $customer->delete();

        return response()->json(['success' => true, 'message' => 'Customer deleted successfully', '_token' => csrf_token()]);
    }
}
