<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Yakin Hapus Data Ini";
        confirmDelete($title, $text);
        return view('surat_keluar.index', [
            'title' => 'Surat keluar',
            'breadcrumbs'    => [
                [
                    'title'    => 'Surat keluar',
                    'link'    => route('surat-keluar')
                ]
                ],
            'suratKeluar' => SuratKeluar::all()
        ]);
    }

    public function create(){
        return view('surat_keluar.action', [
            'title' => 'Tambah Surat Keluar',
            'breadcrumbs'    => [
                [
                    'title'    => 'Tambah Surat Keluar',
                    'link'    => route('surat-keluar.create')
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
            $file->move(storage_path('app/public/file_surat_keluar'), $fileName);
            $last_path = $fileName;
        }

        $suratMasuk = SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_kategori' => $request->id_kategori,
            'id_instasi' => $request->id_instasi,
            'file' => $last_path ?? null
        ]);

        $suratMasuk->update([
            'nomor_surat' => SuratKeluar::createFormatKode($suratMasuk->id),
        ]);

        Alert::toast('Surat Keluar Berhasil Ditambahkan', 'success');
        return redirect()->route('surat-keluar');
    }

    public function edit(SuratKeluar $suratKeluar){
        return view('surat_keluar.action', [
            'title' => 'Tambah Surat Keluar',
            'breadcrumbs'    => [
                [
                    'title'    => 'Tambah Surat Keluar',
                    'link'    => route('surat-keluar.create')
                ]
            ],
            'suratKeluar' => $suratKeluar
        ]);
    }

    public function update(SuratKeluar $suratKeluar, Request $request){
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_masuk' => 'required',
            'id_kategori' => 'required',
            'id_instasi' => 'required',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif,tiff',
        ]);

        if($request->file('file')){
            $file = $request->file('file');
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = date('YmdHis').'.'.$extension;
            $file->move(storage_path('app/public/file_surat_keluar'), $fileName);
            $last_path = $fileName;
        }

        $suratKeluar->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_kategori' => $request->id_kategori,
            'id_instasi' => $request->id_instasi,
            'file' => $last_path ?? $suratKeluar->file,
        ]);

        Alert::toast('Surat Keluar Berhasil Ubah', 'success');
        return redirect()->route('surat-keluar');
    }

    public function destroy(SuratKeluar $suratKeluar){
        $suratKeluar->delete();

        Alert::toast('Surat Masuk Berhasil Dihapus', 'success');
        return redirect()->route('surat-keluar');
        
    }

    public function export(SuratKeluar $suratKeluar){
        $pdf = \PDF::loadview('surat_keluar.export', [
            'surat_keluar' => $suratKeluar
        ])->setPaper('a4', 'Portrait');

        return $pdf->stream('No.Surat_'.$suratKeluar->nomor_surat.'.pdf');
    }
}
