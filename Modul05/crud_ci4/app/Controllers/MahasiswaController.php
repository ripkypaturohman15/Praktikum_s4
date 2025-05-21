<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Controller;

class MahasiswaController extends Controller
{
  protected $mahasiswaModel;

  public function __construct()
  {
    $this->mahasiswaModel = new MahasiswaModel();
  }
  public function index()
  {
    $data['mahasiswa'] = $this->mahasiswaModel->findAll();
    return view('mahasiswa/index', $data);
  }

  public function create()
  {
    return view('mahasiswa/create');
  }
  public function store()
  {
    $this->mahasiswaModel->save([
      'nama' => $this->request->getPost('nama'),
      'email' => $this->request->getPost('email'),
    ]);

    return redirect()->to('/mahasiswa');
  }
}
