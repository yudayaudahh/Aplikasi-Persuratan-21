<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Yakin Hapus Data Ini";
        confirmDelete($title, $text);
        return view('pegawai.index',[
            'title' => 'Data Pegawai',
            'breadcrumbs' => [
                [
                    'title' => 'Data Pegawai',
                    'link' => route('pegawai')
                ]
            ],
            'pegawai' => Pegawai::all()
        ]);
    }

    public function create(){
        return view('pegawai.action', [
            'title' => ' Tambah Data Pegawai',
            'breadcrumbs'    => [
                [
                    'title'    => 'Data Pegawai',
                    'link'    => route('pegawai.create')
                ]
            ]
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        Pegawai::create($request->all());

        Alert::toast('Data Berhasil Di Buat', 'success');
        return redirect()->route('pegawai');
    }

    public function edit(Pegawai $pegawai){
        return view('pegawai.action', [
            'title' => 'Edit Data Pegawai',
            'breadcrumbs'    => [
                [
                    'title'    => 'Edit Data Pegawai',
                    'link'    => route('pegawai.create')
                ]
                ],
                'pegawai' => $pegawai
        ]);
    }

    public function update(Request $request, Pegawai $pegawai){
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        $pegawai->update($request->all());

        Alert::toast('Data Berhasil Di Update', 'success');
        return redirect()->route('pegawai');
    }

    public function destroy(Pegawai $pegawai){
        $pegawai->delete();

        Alert::toast('Data Berhasil Di Hapus', 'success');
        return redirect()->route('pegawai');
    }
}
