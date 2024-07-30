<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MyClass\Kode;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $dates = ['tanggal_masuk'];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function instasi(){
        return $this->belongsTo(Instasi::class, 'id_instasi');
    }

    public static function createFormatKode($idSrtMsk = null)
    {
        // Ambil Tahun Saat Ini
        $tahunIni = date('Y');

        // Cari Transaksi Di Tahun Ini
        $suratTerbaru = self::whereBetween('tanggal_masuk', [$tahunIni . '-01-01', $tahunIni . '-12-31']);
        if ($idSrtMsk != null) {
            $suratTerbaru->whereNotIn('id', [$idSrtMsk]);
        }
        $suratTerbaru->orderBy('created_at', 'DESC')->first();
        $surat = $suratTerbaru->first();

        if ($surat) {
            $noSurat = $surat->nomor_surat;
            $explode = explode('/', $noSurat);
            $noUrut = (int) $explode[0];
            $noUrut++;
        } else {
            $noUrut = 1;
        }
        $urutan = str_pad($noUrut, 4, 0, STR_PAD_LEFT);

        $data = [
            'perusahaan' => 'DINPER',
            'tanggal' => now(),
            'kodeBarang' => 'SRT-KLR',
            'urutan' => $urutan,
        ];

        return Kode::formatNoTransaksi($data);
    }
}
