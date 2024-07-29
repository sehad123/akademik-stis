<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Hapus pengguna dengan email tersebut jika ada
        User::where('email', 'admin@gmail.com')->delete();

        // Tambahkan pengguna baru
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'user_type' => 1 // Pastikan user_type ini sesuai dengan tipe user admin Anda
        ]);
    }
}
