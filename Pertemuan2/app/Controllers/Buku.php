<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $BukuModel;
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
    }
    public function index()
    {
        //$Buku = $this->BukuModel->findAll();

        $data = [
            'title' => 'Daftar Buku',
            'Buku' => $this->BukuModel->getBuku()
        ];


        return view('Buku/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'Buku' => $this->BukuModel->getBuku($slug)
        ];
        return view('Buku/Detail', $data);
    }
}
