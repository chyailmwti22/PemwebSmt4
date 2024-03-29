<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Cahya Ilmawati',
            //'tes' => ['satu', 'dua', 'tiga']
        ];
        return view('page/home', $data);
    }


    public function about()
    {
        $data = [
            'title' => 'About | Cahya Ilmawati',
            //'tes' => ['satu', 'dua', 'tiga']
        ];
        return view('page/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'contact | Cahya Ilmawati',
            'alamat' => [
                ['tipe' => 'Rumah', 'alamat' => 'Jl. KH. Agus Salim 2A Jombatan', 'kota' => 'Jombang'],
                ['tipe' => 'Kantor', 'alamat' => 'Komplek Kampus Unipdu', 'kota' => 'Jombang'],
            ]
        ];
        return view('page/contact', $data);
    }
}
