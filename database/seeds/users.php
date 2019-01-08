<?php

use Illuminate\Database\Seeder;
use App\User;
use App\kategori;
use App\daerah;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('1234567890');
        $user->foto = '/photos/1/Grateful.jpg';
        $user->save();

        $kategori = new kategori;
        $kategori->nama = 'default';
        $kategori->icon = '/marker/default.png';
        $kategori->icon_ex = '/marker/default_ex.png';
        $kategori->save();

        $kategori = new kategori;
        $kategori->nama = 'Jalan';
        $kategori->icon = '/photos/1/road.png';
        $kategori->icon_ex = '/photos/1/road_ex.png';
        $kategori->save();

        $kategori = new kategori;
        $kategori->nama = 'Gedung';
        $kategori->icon = '/photos/1/building.png';
        $kategori->icon_ex = '/photos/1/building_ex.png';
        $kategori->save();

        $kab = [
            ['nama_daerah'     => 'Kab. Bengkayang'],
            ['nama_daerah'     => 'Kab. Kapuas Hulu'],
            ['nama_daerah'     => 'Kab. Kayong Utara'],
            ['nama_daerah'     => 'Kab. Ketapang'],
            ['nama_daerah'     => 'Kab. Kubu Raya'],
            ['nama_daerah'     => 'Kab. Landak'],
            ['nama_daerah'     => 'Kab. Melawi'],
            ['nama_daerah'     => 'Kab. Mempawah'],
            ['nama_daerah'     => 'Kab. Sambas'],
            ['nama_daerah'     => 'Kab. Sanggau'],
            ['nama_daerah'     => 'Kab. Sekadau'],
            ['nama_daerah'     => 'Kab. Sintang'],
            ['nama_daerah'     => 'Kota Pontianak'],
            ['nama_daerah'     => 'Kota Singkawang'],
            ['nama_daerah'     => 'Lainnya']
        ];

        foreach ($kab as $key => $value) {
            daerah::create($value);
        }
    }
}
