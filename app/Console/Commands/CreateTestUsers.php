<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Pelanggan;
use App\Tukang;

class CreateTestUsers extends Command
{
    protected $signature = 'nukang:create-test-users';
    protected $description = 'Create test users for each role';

    public function handle()
    {
        $this->info('=== NUKANG - Create Test Users ===');
        $this->line('');

        // 1. CREATE ADMIN
        $adminEmail = 'admin@nukang.com';
        $admin = User::where('email', $adminEmail)->first();
        if (!$admin) {
            $admin = User::create([
                'email' => $adminEmail,
                'password' => bcrypt('password123'),
                'kodeuser' => 'ADMIN001',
                'statuspengguna' => '0',
                'saldo' => 0,
                'statusverifikasi' => '1',
                'fotoprofil' => 'nopicture.jpg',
            ]);
            $this->info("✓ Admin created: $adminEmail");
        } else {
            $this->line("- Admin already exists: $adminEmail");
        }

        // 2. CREATE PELANGGAN
        $pelangganEmail = 'pelanggan@nukang.com';
        $pelangganUser = User::where('email', $pelangganEmail)->first();
        if (!$pelangganUser) {
            $lastId = User::orderBy('id', 'DESC')->first();
            $newId = $lastId ? $lastId->id + 1 : 1;
            
            // Create pelanggan record first
            $pelangganData = new Pelanggan;
            $pelangganData->id = $newId;
            $pelangganData->namapelanggan = 'Test Pelanggan';
            $pelangganData->save();
            
            $pelangganUser = User::create([
                'email' => $pelangganEmail,
                'password' => bcrypt('password123'),
                'kodeuser' => 'NIP001',
                'statuspengguna' => '1',
                'saldo' => 100000,
                'statusverifikasi' => '1',
                'fotoprofil' => 'nopicture.jpg',
            ]);
            $this->info("✓ Pelanggan created: $pelangganEmail");
        } else {
            $this->line("- Pelanggan already exists: $pelangganEmail");
        }

        // 3. CREATE TUKANG
        $tukangEmail = 'tukang@nukang.com';
        $tukangUser = User::where('email', $tukangEmail)->first();
        if (!$tukangUser) {
            $lastId = User::orderBy('id', 'DESC')->first();
            $newId = $lastId ? $lastId->id + 1 : 1;
            
            // Get first kategori tukang
            $kategori = \App\KategoriTukang::first();
            $kategoriId = $kategori ? $kategori->id : 1;
            
            // Create tukang record first
            Tukang::create([
                'id' => $newId,
                'namatukang' => 'Test Tukang',
                'id_kategoritukang' => $kategoriId,
                'deskripsikeahlian' => 'Tukang profesional untuk testing',
                'lamapengalamanbekerja' => 5,
                'fotoktp' => 'nopicture.jpg',
                'fotosim' => null,
                'fotohasilkerja' => null,
            ]);
            
            $tukangUser = User::create([
                'email' => $tukangEmail,
                'password' => bcrypt('password123'),
                'kodeuser' => 'TAC001',
                'statuspengguna' => '2',
                'saldo' => 50000,
                'statusverifikasi' => '1',
                'fotoprofil' => 'nopicture.jpg',
            ]);
            $this->info("✓ Tukang created: $tukangEmail");
        } else {
            $this->line("- Tukang already exists: $tukangEmail");
        }

        $this->line('');
        $this->info('=== TEST ACCOUNTS ===');
        $this->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin', 'admin@nukang.com', 'password123'],
                ['Pelanggan', 'pelanggan@nukang.com', 'password123'],
                ['Tukang', 'tukang@nukang.com', 'password123'],
            ]
        );
        
        $this->info('Done!');
    }
}
