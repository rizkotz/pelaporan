<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu=[
            [
                'name' => 'Dashboard',
                'link' => '/dashboard',
                'icon' => 'fa-solid fa-gauge',
            ],
            [
                'name' => 'Reviu Laporan Keuangan',
                'link' => '/posts',
                'icon' => 'fa-solid fa-list-check',
            ],
            [
                'name' => 'Laporan Unit kerja',
                'link' => '/dashboard',
                'icon' => 'fa-solid fa-list-check',
            ],
            [
                'name' => 'Audit Eksternal',
                'link' => '/dashboard',
                'icon' => 'fa-solid fa-list-check',
            ],
            [
                'name' => 'Laporan Hasil Pemeriksaan',
                'link' => '/dashboard',
                'icon' => 'fa-solid fa-list-check',
            ],
            [
                'name' => 'Anggota',
                'link' => '/anggotas',
                'icon' => 'fa-solid fa-user',
            ],
            [
                'name' => 'Auditee',
                'link' => '/audites',
                'icon' => 'fa-regular fa-user',
            ],
            [
                'name' => 'Dokumen',
                'link' => '/dokumens',
                'icon' => 'fa-solid fa-file',
            ],
            [
                'name' => 'Menu',
                'link' => '/admin/panel',
                'icon' => 'fa-solid fa-list-check',
            ],
        ];

        foreach($menu as $key => $value){
            Menu::create($value);
        }
    }
}
