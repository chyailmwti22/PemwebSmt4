<?php

namespace App\Controllers;

use App\Models\BooksModel;

class Books extends BaseController
{
    protected $BooksModel;
    public function __construct()
    {
        $this->BooksModel = new BooksModel();
    }
    public function index()
    {
        //$buku = $this->bukuModel->findAll();
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->BooksModel->getBooks()
        ];

        return view('books/index', $data);
    }

    public function detail($slug)
    {
        //$buku = $this->bukuModel->where(['slug' => $slug])->first();


        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->BooksModel->getBooks($slug)
        ];

        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku' . $slug . 'Tidak ditemukan');
        }

        return view('books/detail', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Form Tambah Buku',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];

        return view('books/create', $data);
    }

    public function delete($id)
    {
        $this->BooksModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');

        return redirect()->to('/books');
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'error' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required|is_unique[books.penulis]',
                'error' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_unique[books.penerbit]',
                'error' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'required|is_unique[books.sampul]',
                'error' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ]
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/books/create')->withInput();
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->BooksModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');

        return redirect()->to('/books');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data Buku',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'Books' => $this->BooksModel->getBooks($slug)
        ];

        return view('Books/edit', $data);
    }

    public function update($id)
    {
        //fungsi cek judul buku yang sudah ada
        $booksLama = $this->BooksModel->getBooks($this->request->getVar('slug'));
        if ($booksLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[Books.judul]';
        }
        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'error' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'penerbit' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ]
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->BooksModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diubah');

        return redirect()->to('/books');
    }
}
