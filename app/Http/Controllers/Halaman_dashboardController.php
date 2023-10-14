<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Jenis_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Halaman_dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Surat $surat)
    {
        $surat = Surat::orderby('id_surat','asc')->get();
        return view('dashboard.dashboard')->with(['surat' => $surat]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Jenis_surat $jenis)
    {
        $jenisSuratData = $jenis->all();

        return view('dashboard.tambah', [
            'jenisSurat' => $jenisSuratData,
        ]);
    }

    public function store(Request $request, Surat $surat)
    {
        $data = $request->validate([
            'tanggal_surat' => 'required',
            'ringkasan' => 'required',
            'id_jenis_surat' => 'required',
            'id_user' => 'required',
            'file' => 'required',
        ]);

        $user = Auth::user();
        $data['id_user'] = $user->id_user;
        
        if ($request->hasFile('file')) {
            $foto_file = $request->file('file');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['file'] = $foto_nama;
        }

        if ($surat->create($data)) {
            return redirect('dashboard')->with('success', 'Data surat baru berhasil ditambah');
        }

        return back()->with('error', 'Data surat gagal ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Surat $surat, Jenis_surat $jenis)
    {
        $suratData = Surat::where('id_surat', $id)->first();
        $jenisSuratData = $jenis->all();

        return view('dashboard.edit', [
            'surat' => $suratData,
            'jenisSurat' => $jenisSuratData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Surat $surat)
    {
        $id_surat = $request->input('id_surat');

        $data = $request->validate([
            'tanggal_surat' => 'sometimes',
            'ringkasan' => 'sometimes',
            'id_jenis_surat' => 'sometimes',
            'file' => 'sometimes|file',
        ]);

        if ($id_surat !== null) {
            if ($request->hasFile('file')) {
                $foto_file = $request->file('file');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);

                $update_data = $surat->where('id_surat', $id_surat)->first();
                File::delete(public_path('foto') . '/' . $update_data->file);

                $data['file'] = $foto_nama;
            }

            $dataUpdate = $surat->where('id_surat', $id_surat)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard')->with('success', 'Data surat berhasil diupdate');
            }

            return back()->with('error', 'Data jenis surat gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surat $surat, Request $request)
    {
        $id_surat = $request->input('id_surat');
        $data = Surat::find($id_surat);

        if (!$data) {
            return response()->json(['success' => false, 'pesan' => 'Data tidak ditemukan'], 404);
        }

        $filePath = public_path('foto') . '/' . $data->file;

        if (file_exists($filePath) && unlink($filePath)) {
            $data->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'pesan' => 'Data gagal dihapus']);
    }
}