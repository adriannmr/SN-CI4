<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EmployeeModel;

class Home extends BaseController
{
    public function index()
    {
        // Mengecek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Inisialisasi model Employee
        $employeeModel = new EmployeeModel();
        
        // Mengambil semua data dari tabel employees
        $data['employees'] = $employeeModel->findAll();

        // Load view dan kirim data ke view
        return view('home/index', $data);
    }
}
    