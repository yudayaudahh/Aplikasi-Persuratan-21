<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SuratMasukController extends Controller
{
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Yakin Hapus Data Ini";
        confirmDelete($title, $text);
        return view('surat_masuk.index', [
            'title' => 'Surat Masuk',
            'breadcrumbs'    => [
                [
                    'title'    => 'Surat Masuk',
                    'link'    => route('surat-masuk')
                ]
                ],
            'suratMasuk' => SuratMasuk::all()
        ]);
    }

    public function create(){
        return view('surat_masuk.action', [
            'title' => 'Tambah Surat Masuk',
            'breadcrumbs'    => [
                [
                    'title'    => 'Tambah Surat Masuk',
                    'link'    => route('surat-masuk.create')
                ]
                ],
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_masuk' => 'required',
            'id_kategori' => 'required',
            'id_instasi' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,gif,tiff',
        ]);

        if($request->file('file')){
            $file = $request->file('file');
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = date('YmdHis').'.'.$extension;
            $file->move(storage_path('app/public/file_surat_masuk'), $fileName);
            $last_path = $fileName;
        }

        $suratMasuk = SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_kategori' => $request->id_kategori,
            'id_instasi' => $request->id_instasi,
            'file' => $last_path ?? null
        ]);

        $suratMasuk->update([
            'nomor_surat' => SuratMasuk::createFormatKode($suratMasuk->id),
        ]);

        Alert::toast('Surat Masuk Berhasil Ditambahkan', 'success');
        return redirect()->route('surat-masuk');
    }

    public function edit(SuratMasuk $suratMasuk){
        return view('surat_masuk.action', [
            'title' => 'Tambah Surat Masuk',
            'breadcrumbs'    => [
                [
                    'title'    => 'Tambah Surat Masuk',
                    'link'    => route('surat-masuk.create')
                ]
                ],
            'suratMasuk' => $suratMasuk
        ]);
    }

    public function update(SuratMasuk $suratMasuk, Request $request){
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_masuk' => 'required',
            // 'id_kategori' => 'required',
            // 'id_instasi' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,gif,tiff',
        ]);

        if($request->file('file')){
            $file = $request->file('file');
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = date('YmdHis').'.'.$extension;
            $file->move(storage_path('app/public/file_surat_masuk'), $fileName);
            $last_path = $fileName;
        }

        $suratMasuk->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_kategori' => $request->id_kategori,
            'id_instasi' => $request->id_instasi,
            'file' => $last_path ?? $suratMasuk->file
        ]);

        Alert::toast('Surat Masuk Berhasil Diubah', 'success');
        return redirect()->route('surat-masuk');
    }

    public function destroy(SuratMasuk $suratMasuk){
        Storage::delete('app/public/file_surat_masuk/'.$suratMasuk->file);
        $suratMasuk->delete();

        Alert::toast('Surat Masuk Berhasil Dihapus', 'success');
        return redirect()->route('surat-masuk');
    }

    public function export(SuratMasuk $suratMasuk){
        $pdf = \PDF::loadview('surat_masuk.export', [
            'surat_masuk' => $suratMasuk
        ])->setPaper('a4', 'Portrait');

        return $pdf->stream('No.Surat_'.$suratMasuk->nomor_surat.'.pdf');
    }
}
