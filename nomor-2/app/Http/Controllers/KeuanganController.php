<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeuanganModel;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->Keuangan_m = new KeuanganModel;
    }

    public function index()
    {
        $pemasukan = $this->Keuangan_m->pemasukan();
        $pengeluaran = $this->Keuangan_m->pengeluaran();
        $hasilpem = 0;
        $hasilpeng = 0;
        $hasil = 0;
        foreach ($pemasukan as $v) {
            $hasilpem += $v->jumlah;
        }

        foreach ($pengeluaran as $key) {
            $hasilpeng += $key->jumlah;
        }
        $hasil = $hasilpem - $hasilpeng;
        $data = [
            'title' => 'Semua Transaksi',
            'pemasukans' => $hasilpem,
            'pengeluarans' => $hasilpeng,
            'jml' => $hasil,
            'transaksi' => $this->Keuangan_m->semua()
        ];
        return view('keuangan', $data);
    }

    public function insert()
    {
        // Request()->validate(
        //     [
        //         'kecamatan' => 'required',
        //         'warna' => 'required',
        //         'geojson' => 'required',
        //     ],
        //     [
        //         'kecamatan.required' => 'Wajib di isi!!!',
        //         'warna.required' => 'Wajib di isi!!!',
        //         'geojson.required' => 'Wajib di isi!!!',
        //     ]
        // );

        //jika melewati syarat maka insert database
        $data = [
            'keterangan' => Request()->keterangan,
            'jenis' => Request()->jenis,
            'tanggal' => Request()->tanggal,
            'jumlah' => Request()->jumlah,
        ];

        $this->Keuangan_m->simpan($data);

        return redirect()->route('keuangan')->with('pesan', 'Data Berhasil Ditambahkan');
    }

    public function update($id)
    {
        $data = [
            'keterangan' => Request()->keterangan,
            'jenis' => Request()->jenis,
            'tanggal' => Request()->tanggal,
            'jumlah' => Request()->jumlah,
        ];
        $this->Keuangan_m->update_data($data, $id);

        return redirect()->route('keuangan')->with('pesan', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $this->Keuangan_m->delete_data($id);

        return redirect()->route('keuangan')->with('pesan', 'Data Berhasil Dihapus');
    }
}
