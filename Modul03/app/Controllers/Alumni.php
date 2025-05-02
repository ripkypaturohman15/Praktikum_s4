<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AlumniModel;

class Alumni extends Controller {
    protected $alumniModel;
    
    public function __construct()
    {
        $this->alumniModel = new AlumniModel();
    }
    
    public function index()
    {
        $data['alumni'] = $this->alumniModel->getAlumni();
        return view('alumni/index', $data);
    }
    
    public function create()
    {
        return view('alumni/create');
    }
    
    public function store()
    {
        $this->alumniModel->addAlumni([
            'nama' => $this->request->getPost('nama'),
            'angkatan' => $this->request->getPost('angkatan'),
            'jurusan' => $this->request->getPost('jurusan'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon')
        ]);
        return redirect()->to('/alumni');
    }

    public function edit($id = null)
    {
        $data['alumni'] = $this->alumniModel->getAlumniById($id);
        if (empty($data['alumni'])) {
            return redirect()->to('/alumni');
        }
        return view('alumni/edit', $data);
    }

    public function update($id = null)
    {
        $this->alumniModel->updateAlumni($id, [
            'nama' => $this->request->getPost('nama'),
            'angkatan' => $this->request->getPost('angkatan'),
            'jurusan' => $this->request->getPost('jurusan'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon')
        ]);
        return redirect()->to('/alumni');
    }

    public function delete($id = null)
    {
        $this->alumniModel->deleteAlumni($id);
        return redirect()->to('/alumni');
    }
}