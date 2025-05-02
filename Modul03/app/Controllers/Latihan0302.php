<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Latihan0302 extends BaseController
{
    // Menampilkan form biodata
    public function index()
    {
        return view('Modul03/formBiodata');
    }

    // Menampilkan form Biodata
    public function formBiodata()
    {
        return view('Modul03/formBiodata');
    }

    // Menyimpan data dan menampilkan salam
    public function store()
    {
        // Mendapatkan data dari form input
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
        ];

        // Menampilkan view salam dengan data yang telah diposting
        return view('Modul03/salam', $data);
    }
}
