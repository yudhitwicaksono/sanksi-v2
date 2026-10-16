<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // If already logged in, redirect to main
        if (session()->get('username')) {
            return redirect()->to(site_url('main/index'));
        }
        return view('login');
    }

    public function validasiLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->db->table('user')
            ->where('username', $username)
            ->where('password', $password)
            ->get()
            ->getRow();

        if ($user) {
            $sessData = [
                'username' => $user->username,
                'role'     => $user->role,
                'nama'     => $user->username,
                'foto'     => '',
            ];

            if ($user->role === 'Admin' || $user->role === 'Bagian Kedisiplinan') {
                $guru = $this->db->table('bagian_kedisiplinan')
                    ->where('nip', $username)
                    ->get()
                    ->getRow();
                if ($guru) {
                    $sessData['nama'] = $guru->nama_guru;
                    $sessData['foto'] = $guru->foto;
                }
            } elseif ($user->role === 'Siswa') {
                $siswa = $this->db->table('siswa')
                    ->where('nis', $username)
                    ->get()
                    ->getRow();
                if ($siswa) {
                    $sessData['nama'] = $siswa->nama_siswa;
                    $sessData['foto'] = $siswa->foto;
                }
            }

            $sessData['pesan'] = 'Selamat Datang ' . $user->role . ' ' . $sessData['nama'] . ' di Aplikasi Sanksi dan Pelanggaran';
            $sessData['parameter'] = '1';

            session()->set($sessData);
            return redirect()->to(site_url('main/index'));
        }

        return redirect()->back()->with('error', 'Gagal login: Periksa username dan password Anda!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login/index'))->with('success', 'Berhasil Logout.');
    }
}
