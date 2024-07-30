<?php

namespace App\Http\Controllers;

use App\Models\Instasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InstasiController extends Controller
{
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Yakin Hapus Data Ini";
        confirmDelete($title, $text);
        return view('instasi.index', [
            'title' => 'Penerima Surat',
            'breadcrumbs'    => [
                [
                    'title'    => 'Penerima Surat',
                    'link'    => route('instasi')
                ]
                ],
            'instasi' => Instasi::all()
        ]);
    }

    public function create(){
        return view('instasi.action', [
            'title' => ' Tambah Penerima Surat',
            'breadcrumbs'    => [
                [
                    'title'    => 'Penerima Surat',
                    'link'    => route('instasi.create')
                ]
                ],
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        Instasi::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);

        Alert::toast('Data Berhasil Di Buat', 'success');
        return redirect()->route('instasi');
    }

    public function edit(Instasi $instasi){
        return view('instasi.action', [
            'title' => ' Tambah Penerima Surat',
            'breadcrumbs'    => [
                [
                    'title'    => 'Penerima Surat',
                    'link'    => route('instasi.create')
                ]
            ],
            'instasi' => $instasi
        ]);
    }

    public function update(Request $request, Instasi $instasi){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        $instasi->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);

        Alert::toast('Data Berhasil Di Update', 'success');
        return redirect()->route('instasi');
    }

    public function destroy(Instasi $instasi){
        $instasi->delete();
        Alert::toast('Data Berhasil Di Hapus', 'success');

        return redirect()->route('instasi');
    }
}
