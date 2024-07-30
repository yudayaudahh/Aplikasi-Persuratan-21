<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;


class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Yakin Hapus Data Ini";
        confirmDelete($title, $text);
        return view('kategori.index', [
            'title' => 'Kategori Surat',
            'breadcrumbs' => [
                [
                    'title' => 'Kategori Surat',
                    'link' => route('kategori')
                ]
            ],
            'kategori' => Kategori::all()
        ]);
    }

    public function create(){
        return view('kategori.action', [
            'title' => 'Tambah Kategori Surat',
            'breadcrumbs' => [
                [
                    'title' => 'Tambah Kategori Surat',
                    'link' => route('kategori.create')
                ]
            ],
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        // Menyimpan Data
        Kategori::create($request->all());

        Alert::toast('Data Berhasil Di Buat', 'success');
        return redirect()->route('kategori');
    }

    public function edit(Kategori $kategori){
        return view('kategori.action', [
            'title' => 'Tambah Kategori Surat',
            'breadcrumbs' => [
                [
                    'title' => 'Tambah Kategori Surat',
                    'link' => route('kategori.create')
                ]
            ],
            'kategori' => $kategori
        ]);
    }

    public function update(Kategori $kategori, Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        // Menyimpan Data
        $kategori->update($request->all());

        Alert::toast('Data Berhasil Di Ubah', 'success');
        return redirect()->route('kategori');
    }

    public function destroy(Kategori $kategori){
        $kategori->delete();

        Alert::toast('Data Berhasil Di Hapus', 'success');
        return redirect()->route('kategori');
    }
}
