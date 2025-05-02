<?php

namespace App\Models;

class AlumniModel {
    private static $alumni = [];

    public function __construct()
    {
        if (!session()->has('alumni')) {
            session()->set('alumni', [
                ['id' => 1, 'nama' => 'Hari Inaka Hermawan', 'angkatan' => 2025, 'jurusan' => 'Sistem Informasi', 'email' => 'hariinaka@gmail.com', 'telepon' => '087735495286'],
                ['id' => 2, 'nama' => 'Milchatun', 'angkatan' => 2025, 'jurusan' => 'Informatika', 'email' => 'siti@example.com', 'telepon' => '08125451729']
            ]);
        }
        self::$alumni = session()->get('alumni');
    }

    public function getAlumni()
    {
        return self::$alumni;
    }

    public function getAlumniById($id)
    {
        foreach (self::$alumni as $alumni) {
            if ($alumni['id'] == $id) {
                return $alumni;
            }
        }
        return null;
    }

    public function addAlumni($data)
    {
        $data['id'] = count(self::$alumni) + 1;
        self::$alumni[] = $data;
        session()->set('alumni', self::$alumni);
    }

    public function updateAlumni($id, $data)
    {
        foreach (self::$alumni as $key => $value) {
            if ($value['id'] == $id) {
                self::$alumni[$key]['nama'] = $data['nama'];
                self::$alumni[$key]['angkatan'] = $data['angkatan'];
                self::$alumni[$key]['jurusan'] = $data['jurusan'];
                self::$alumni[$key]['email'] = $data['email'];
                self::$alumni[$key]['telepon'] = $data['telepon'];
                break;
            }
        }
        session()->set('alumni', self::$alumni);
    }

    public function deleteAlumni($id)
    {
        foreach (self::$alumni as $key => $value) {
            if ($value['id'] == $id) {
                unset(self::$alumni[$key]);
                break;
            }
        }
        // Re-index array
        self::$alumni = array_values(self::$alumni);
        session()->set('alumni', self::$alumni);
    }
}