<?php

namespace App\Http\Controllers;

use App\DataTables\TokoDataTable;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokoController extends Controller
{
    public function index(TokoDataTable $datatable)
    {
        return $datatable->render('toko.index');
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'logo ' =>  'nullable|mimes:png,jpg,jpeg|max:5048',
            'nama_toko' => 'required|min:3|max:100',
            'domisili' => 'required|min:3|max:100',
            'alamat_usaha' => 'required|min:3|max:100',
            'nohp' => 'required|min:11|max:16'

        ],[
            'logo.required' => 'Logo toko wajib diisi',
            'logo.accepted' => 'Format logo harus jpg, jpeg, png',
            'logo.max' => 'Ukuran logo maksimal 5MB',
            'nama_toko.required' => 'Nama toko wajib diisi',
            'nama_toko.min' => 'Nama toko minimal 3 karakter',
            'nama_toko.max' => 'Nama toko maksimal 100 karakter',
            'domisili.required' => 'Domisili wajib diisi',
            'domisili.min' => 'Domisili minimal 3 karakter',
            'domisili.max' => 'Domisili maksimal 100 karakter',
            'alamat_usaha.required' => 'Alamat usaha wajib diisi',
            'alamat_usaha.min' => 'Alamat usaha minimal 3 karakter',
            'alamat_usaha.max' => 'Alamat usaha maksimal 100 karakter',
            'nohp.required' => 'No. HP wajib diisi',
            'nohp.min' => 'No. HP minimal 11 karakter',
            'nohp.max' => 'No. HP maksimal 16 karakter'

        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/toko'), $filename);  

        }
        
        $request->except('logo');   
        
        Toko::create([
            'logo' => $filename,
            'nama_toko' => $request->nama_toko,
            'domisili' => $request->domisili,
            'alamat_usaha' => $request->alamat_usaha,
            'nohp' => $request->nohp
        ]);

        return response()->json(['success' => true, 'message' => 'Toko created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $toko = Toko::find($id);

        if (!$toko) {
            return response()->json(['success' => false, 'message' => 'Toko not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $toko, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logo ' =>  'nullable|mimes:png,jpg,jpeg|max:5048',
            'nama_toko' => 'required|min:3|max:100',
            'domisili' => 'required|min:3|max:100',
            'alamat_usaha' => 'required|min:3|max:100',
            'nohp' => 'required|min:11|max:16'

        ],[
            'logo.required' => 'Logo toko wajib diisi',
            'logo.accepted' => 'Format logo harus jpg, jpeg, png',
            'logo.max' => 'Ukuran logo maksimal 5MB',
            'nama_toko.required' => 'Nama toko wajib diisi',
            'nama_toko.min' => 'Nama toko minimal 3 karakter',
            'nama_toko.max' => 'Nama toko maksimal 100 karakter',
            'domisili.required' => 'Domisili wajib diisi',
            'domisili.min' => 'Domisili minimal 3 karakter',
            'domisili.max' => 'Domisili maksimal 100 karakter',
            'alamat_usaha.required' => 'Alamat usaha wajib diisi',
            'alamat_usaha.min' => 'Alamat usaha minimal 3 karakter',
            'alamat_usaha.max' => 'Alamat usaha maksimal 100 karakter',
            'nohp.required' => 'No. HP wajib diisi',
            'nohp.min' => 'No. HP minimal 11 karakter',
            'nohp.max' => 'No. HP maksimal 16 karakter'

        ]);
    //   upload image
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/toko'), $filename);  

        }

        

        $toko = Toko::find($id);

        if (!$toko) {
            return response()->json(['success' => false, 'message' => 'Toko not found'], 404);
        }

        $update = [
            'logo' => $filename,
            'nama_toko' => $request->nama_toko,
            'domisili' => $request->domisili,
            'alamat_usaha' => $request->alamat_usaha,
            'nohp' => $request->nohp
        ];

        $toko->update($update);

        return response()->json(['success' => true, 'message' => 'Toko update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $toko = Toko::find($id);

        if (!$toko) {
            return response()->json(['success' => true, 'message' => 'Toko not found'], 404);
        }

        $toko->delete();

        return response()->json(['success' => true, 'message' => 'Toko deleted successfully', '_token' => csrf_token()]);
    }
}
