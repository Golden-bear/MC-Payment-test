<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KeuanganModel extends Model
{
    public function simpan($data)
    {
        DB::table('transaksi')->insert($data);
    }

    public function semua()
    {
        return DB::table('transaksi')->get();
    }

    public function transaksi_detail($id)
    {
        return DB::table('transaksi')->where('id', $id)->first();
    }

    public function update_data($data, $id)
    {
        DB::table('transaksi')->where('id', $id)->update($data);
    }

    public function delete_data($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();
    }

    public function pemasukan()
    {
        return DB::table('transaksi')->where('jenis', 'Kas Masuk')->get();
    }

    public function pemasukan_detail($id)
    {
        return DB::table('transaksi')->where(array('id' => $id, 'jenis' => 'Kas Masuk'))->get();
    }




    public function pengeluaran()
    {
        return DB::table('transaksi')->where('jenis', 'Kas Keluar')->get();
    }
    public function pengeluaran_detail($id)
    {
        return DB::table('transaksi')->where(array('id' => $id, 'jenis' => 'Kas Keluar'))->get();
    }
}
