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

        //jika buku tidak ada
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku' . $slug . 'Tidak Ditemukan');
        }

        return view('Buku/Detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Detail Buku'
        ];

        return view('Buku/create', $data);
    }

    public function save()
    {
        //$this->request->getVar('judul);

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->BukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/Buku');
    }
}
