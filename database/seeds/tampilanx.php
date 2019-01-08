<?php

use Illuminate\Database\Seeder;
use App\tampilan;

class tampilanx extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tampilan = new tampilan;
        $tampilan->favicon = '/photos/1/Logo Provinsi Kalimantan Barat.png';
        $tampilan->logo_instansi = '/photos/1/logoPU.jpg';
        $tampilan->nama_instansi = 'Pekerjaan Umum';
        $tampilan->logo_pem = '/photos/1/Logo Provinsi Kalimantan Barat.png';
        $tampilan->nama_pem = 'Provinsi Kalimantan Barat';
        $tampilan->logo_aplikasi = '#';
        $tampilan->nama_aplikasi = 'SISTEM INFORMASI GEOGRAFIS';
        $tampilan->site_title = 'SISTEM INFORMASI GEOGRAFIS';
        $tampilan->site_keyword = 'SISTEM INFORMASI GEOGRAFIS';
        $tampilan->site_desc = 'SISTEM INFORMASI GEOGRAFIS';
        $tampilan->tentang = 'SISTEM INFORMASI GEOGRAFIS';
        $tampilan->save();
    }
}
