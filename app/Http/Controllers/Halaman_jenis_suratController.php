<?php

namespace App\Http\Controllers;

use App\Models\Jenis_surat;
use Illuminate\Http\Request;

class Halaman_jenis_suratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Jenis_surat $jenis)
    {
        $data = [
            'jenis' => $jenis->all()
        ];
        return view('jenis.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Jenis_surat $jenis)
    {
        $data = $request->validate(
            [
                'jenis_surat'    => ['required'],
            ]
        );

        //Proses Insert
        if ($data) {
            $data['id_jenis_surat'] = 1;
            // Simpan jika data terisi semua
            $jenis->create($data);
            return redirect('/jenis_surat')->with('success', 'Data jenis surat baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data jenis surat gagal ditambahkan');
        }
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
    public function edit(string $id, Request $request, Jenis_surat $jenis)
    {
        $data = [
            'jenis' =>  Jenis_surat::where('id_jenis_surat', $id)->first()
        ];

        return view('jenis.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis_surat $jenis)
    {
        $data = $request->validate([
            'jenis_surat' => ['required'],
        ]);

        $id_jenis_surat = $request->input('id_jenis_surat');

        if ($id_jenis_surat !== null) {
            // Process Update
            $dataUpdate = $jenis->where('id_jenis_surat', $id_jenis_surat)->update($data);

            if ($dataUpdate) {
                return redirect('/jenis_surat')->with('success', 'Data jenis surat berhasil di update');
            } else {
                return back()->with('error', 'Data jenis surat gagal di update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis_surat $jenis, Request $request)
    {
        $id_jenis_surat = $request->input('id_jenis_surat');

        // Hapus 
        $aksi = $jenis->where('id_jenis_surat', $id_jenis_surat)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data jenis surat berhasil dihapus'
            ];
        } else {
            // Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
}