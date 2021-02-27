<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeuanganModel;

class KeuanganApi extends Controller
{
    public function __construct()
    {
        $this->Keuangan_m = new KeuanganModel;
    }

    public function semua()
    {
        $transaksi = $this->Keuangan_m->semua();
        return response()->json(
            [
                "message" => "success",
                "data" => $transaksi
            ]
        );
    }

    public function pemasukans()
    {
        $pemasukan = $this->Keuangan_m->pemasukan();
        return response()->json(
            [
                "message" => "success",
                "data" => $pemasukan
            ]
        );
    }

    public function get_detail_pemasukan($id)
    {
        $pemasukan = $this->Keuangan_m->pemasukan_detail($id);
        return response()->json(
            [
                "message" => "success",
                "data" => $pemasukan
            ]
        );
    }

    public function post_pemasukans(Request $request)
    {

        $data = [
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah
        ];

        $this->Keuangan_m->simpan($data);

        return response()->json(
            [
                "message" => "success",
                "data" => $data
            ]
        );
    }

    public function put($id, Request $request)
    {
        $tr = $this->Keuangan_m->transaksi_detail($id);
        if ($tr) {
            $data = [
                'keterangan' => $request->keterangan ? $request->keterangan : $tr->keterangan,
                'jenis' => $request->jenis ? $request->jenis : $tr->jenis,
                'tanggal' => $request->tanggal ? $request->tanggal : $tr->tanggal,
                'jumlah' => $request->jumlah ? $request->jumlah : $tr->jumlah
            ];
            $this->Keuangan_m->update_data($data, $id);

            return response()->json(
                [
                    "message" => "Update Success",
                    "data" => $data
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "Data Tidak Ditemukan"
                ]
            );
        }
    }

    public function delete($id)
    {
        $tr = $this->Keuangan_m->transaksi_detail($id);

        if ($tr) {
            $this->Keuangan_m->delete_data($id);
            return response()->json(
                [
                    "message" => "success delete",
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "error",
                ]
            );
        }
    }


    public function pengeluarans()
    {
        $pengeluaran = $this->Keuangan_m->pengeluaran();
        return response()->json(
            [
                "message" => "success",
                "data" => $pengeluaran
            ]
        );
    }

    public function get_detail_pengeluaran($id)
    {
        $pemasukan = $this->Keuangan_m->pengeluaran_detail($id);
        return response()->json(
            [
                "message" => "success",
                "data" => $pemasukan
            ]
        );
    }


    public function sisa()
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
        return response()->json(
            [
                "message" => "success",
                "Sisa Uang" => $hasil
            ]
        );
    }
}
