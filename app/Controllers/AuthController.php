<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // If the user is already logged in, redirect to home
        if (session()->get('logged_in')) {
            return redirect()->to('/home');
        }

        // Show the login form
        return view('auth/login');
    }

    public function authenticate()
    {
        // Mengambil input dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validate inputs
        if (empty($username) || empty($password)) {
            session()->setFlashdata('error', 'Username dan password harus diisi');
            return redirect()->back()->withInput();
        }

        // Inisialisasi model User
        $userModel = new UserModel();

        // Mencari user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        // Cek apakah user ditemukan dan password sesuai
        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session to prevent session fixation
            session()->regenerate();

            // Set session data for login
            session()->set([
                'username' => $user['username'],
                'logged_in' => true
            ]);

            // Redirect ke halaman home
            return redirect()->to('/home');
        } else {
            // Jika salah, redirect kembali ke login dengan pesan error
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->back()->withInput(); // withInput keeps the form data
        }
    }

    public function register()
    {
        return view('auth/register'); // Load view registrasi
    }

    public function storeRegistration()
    {
        // Validasi input
        $validation = $this->validate([
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[5]',
            'password_confirm' => 'matches[password]'
        ]);

        if (!$validation) {
            session()->setFlashdata('error', 'Data yang diinput tidak valid');
            return redirect()->back()->withInput();
        }

        // Hash password
        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Simpan user baru ke database
        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => $hashedPassword
        ]);

        // Berikan pesan sukses dan redirect ke halaman login
        session()->setFlashdata('success', 'Registrasi berhasil, silakan login');
        return redirect()->to('/login');
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();
        return redirect()->to('/login');
    }
}
