<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Admin::truncate();

      $admin = new Admin();
      $admin->name = 'Mark Anthony';
      $admin->email = 'admin@gmail.com';
      $admin->photo = '';
      $admin->password = Hash::make('1234');
      $admin->token = '';
      $admin->save();
    }
}
