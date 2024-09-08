<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees'; // Nama tabel
    protected $primaryKey = 'id';   // Primary key tabel

    protected $allowedFields = ['name', 'position', 'office', 'age', 'start_date', 'salary'];

    // Optional: Atur tipe data jika dibutuhkan
    protected $useTimestamps = false; // Gunakan timestamp jika kolom `created_at` dan `updated_at` ada
}
