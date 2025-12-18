<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Pelanggan;
use App\Tukang;
use App\KategoriTukang;
use App\JenisPemesanan;
use App\BahanMaterial;
use App\HargaJarak;

class TestUsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     * Creates test users for Admin, Pelanggan, and Tukang roles
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Creating Test Users ===');
        
        // ===============================
        // 1. CREATE HARGA JARAK (Required)
        // ===============================
        if (!HargaJarak::find(1)) {
            HargaJarak::create([
                'id_hargajarak' => 1,
                'hargajarak' => 5000, // Rp 5000 per km
            ]);
            $this->command->info('✓ Harga Jarak created');
        }

        // ===============================
        // 2. CREATE KATEGORI TUKANG
        // ===============================
        $kategoris = [
            ['nama_kategoritukang' => 'Tukang Bangunan', 'gambar_kategoritukang' => 'bangunan.png'],
            ['nama_kategoritukang' => 'Tukang Listrik', 'gambar_kategoritukang' => 'listrik.png'],
            ['nama_kategoritukang' => 'Tukang Pipa/Plumbing', 'gambar_kategoritukang' => 'pipa.png'],
            ['nama_kategoritukang' => 'Tukang Cat', 'gambar_kategoritukang' => 'cat.png'],
            ['nama_kategoritukang' => 'Tukang Kayu', 'gambar_kategoritukang' => 'kayu.png'],
        ];

        foreach ($kategoris as $kat) {
            $exists = KategoriTukang::where('nama_kategoritukang', $kat['nama_kategoritukang'])->first();
            if (!$exists) {
                KategoriTukang::create($kat);
            }
        }
        $this->command->info('✓ Kategori Tukang created');

        // Get first kategori for tukang
        $kategori = KategoriTukang::first();
        $kategoriId = $kategori ? $kategori->id_kategoritukang : 1;

        // ===============================
        // 3. CREATE JENIS PEMESANAN
        // ===============================
        $jenisPemesanans = [
            ['namajenispemesanan' => 'Renovasi Rumah', 'id_kategoritukang' => $kategoriId],
            ['namajenispemesanan' => 'Perbaikan Atap', 'id_kategoritukang' => $kategoriId],
            ['namajenispemesanan' => 'Instalasi Listrik', 'id_kategoritukang' => $kategoriId],
            ['namajenispemesanan' => 'Perbaikan Pipa', 'id_kategoritukang' => $kategoriId],
            ['namajenispemesanan' => 'Pengecatan', 'id_kategoritukang' => $kategoriId],
        ];

        foreach ($jenisPemesanans as $jp) {
            $exists = JenisPemesanan::where('namajenispemesanan', $jp['namajenispemesanan'])->first();
            if (!$exists) {
                JenisPemesanan::create($jp);
            }
        }
        $this->command->info('✓ Jenis Pemesanan created');

        // ===============================
        // 4. CREATE BAHAN MATERIAL
        // ===============================
        $materials = [
            ['bahanmaterial' => 'Semen 50kg', 'hargabahanmaterial' => 75000, 'stokbahanmaterial' => 100, 'id_kategoritukang' => $kategoriId, 'statusbahanmaterial' => '1'],
            ['bahanmaterial' => 'Pasir 1 Truk', 'hargabahanmaterial' => 500000, 'stokbahanmaterial' => 50, 'id_kategoritukang' => $kategoriId, 'statusbahanmaterial' => '1'],
            ['bahanmaterial' => 'Bata Merah (1000 pcs)', 'hargabahanmaterial' => 800000, 'stokbahanmaterial' => 30, 'id_kategoritukang' => $kategoriId, 'statusbahanmaterial' => '1'],
            ['bahanmaterial' => 'Cat Tembok 5L', 'hargabahanmaterial' => 150000, 'stokbahanmaterial' => 200, 'id_kategoritukang' => $kategoriId, 'statusbahanmaterial' => '1'],
            ['bahanmaterial' => 'Pipa PVC 4 inch', 'hargabahanmaterial' => 45000, 'stokbahanmaterial' => 150, 'id_kategoritukang' => $kategoriId, 'statusbahanmaterial' => '1'],
        ];

        foreach ($materials as $mat) {
            $exists = BahanMaterial::where('bahanmaterial', $mat['bahanmaterial'])->first();
            if (!$exists) {
                BahanMaterial::create($mat);
            }
        }
        $this->command->info('✓ Bahan Material created');

        // ===============================
        // 5. CREATE ADMIN USER
        // ===============================
        $adminEmail = 'admin@nukang.com';
        $admin = User::where('email', $adminEmail)->first();
        if (!$admin) {
            User::create([
                'email' => $adminEmail,
                'password' => bcrypt('password123'),
                'kodeuser' => 'ADMIN001',
                'statuspengguna' => '0',
                'saldo' => 0,
                'statusverifikasi' => '1',
                'fotoprofil' => 'nopicture.jpg',
            ]);
            $this->command->info('✓ Admin created: ' . $adminEmail);
        } else {
            $this->command->info('- Admin already exists: ' . $adminEmail);
        }

        // ===============================
        // 6. CREATE PELANGGAN USER
        // ===============================
        $pelangganEmail = 'pelanggan@nukang.com';
        $pelangganUser = User::where('email', $pelangganEmail)->first();
        if (!$pelangganUser) {
            // Get next ID
            $lastUser = User::orderBy('id', 'DESC')->first();
            $newId = $lastUser ? $lastUser->id + 1 : 1;
            
            // Create pelanggan record
            $pelanggan = new Pelanggan;
            $pelanggan->id = $newId;
            $pelanggan->namapelanggan = 'Test Pelanggan';
            $pelanggan->save();
            
            // Create user
            User::create([
                'email' => $pelangganEmail,
                'password' => bcrypt('password123'),
                'kodeuser' => 'NIP001',
                'statuspengguna' => '1',
                'saldo' => 500000, // Saldo awal 500rb
                'statusverifikasi' => '1',
                'fotoprofil' => 'nopicture.jpg',
                'latitude' => '3.5952',
                'longtitude' => '98.6722',
                'alamat' => 'Jl. Test Pelanggan No. 1, Medan',
                'nomorhandphone' => '081234567891',
            ]);
            $this->command->info('✓ Pelanggan created: ' . $pelangganEmail);
        } else {
            $this->command->info('- Pelanggan already exists: ' . $pelangganEmail);
        }

        // ===============================
        // 7. CREATE TUKANG USER
        // ===============================
        $tukangEmail = 'tukang@nukang.com';
        $tukangUser = User::where('email', $tukangEmail)->first();
        if (!$tukangUser) {
            // Get next ID
            $lastUser = User::orderBy('id', 'DESC')->first();
            $newId = $lastUser ? $lastUser->id + 1 : 1;
            
            // Create tukang record
            Tukang::create([
                'id' => $newId,
                'namatukang' => 'Test Tukang Profesional',
                'id_kategoritukang' => $kategoriId,
                'deskripsikeahlian' => 'Tukang profesional berpengalaman 5 tahun. Spesialisasi: renovasi rumah, perbaikan atap, instalasi listrik dan plumbing. Mengutamakan kualitas dan kepuasan pelanggan.',
                'lamapengalamanbekerja' => 5,
                'pengalamanbekerja' => 'Renovasi Rumah Mewah di Medan~Perbaikan Gedung Perkantoran~Instalasi Listrik Rumah Sakit',
                'fotoktp' => 'nopicture.jpg',
                'fotosim' => null,
                'fotohasilkerja' => null,
                'rating' => 4.5,
                'jumlahvote' => 10,
                'totalvote' => 45,
                'statuseditprofil' => '1',
                'statusjasakeahlian' => '1',
            ]);
            
            // Create user
            User::create([
                'email' => $tukangEmail,
                'password' => bcrypt('password123'),
                'kodeuser' => 'TAC001',
                'statuspengguna' => '2',
                'saldo' => 250000, // Saldo awal 250rb
                'statusverifikasi' => '1',
                'fotoprofil' => 'nopicture.jpg',
                'latitude' => '3.5900',
                'longtitude' => '98.6700',
                'alamat' => 'Jl. Test Tukang No. 2, Medan',
                'nomorhandphone' => '081234567892',
                'nomorrekening' => '1234567890',
                'namarekening' => 'Test Tukang',
            ]);
            $this->command->info('✓ Tukang created: ' . $tukangEmail);
        } else {
            $this->command->info('- Tukang already exists: ' . $tukangEmail);
        }

        // ===============================
        // 8. CREATE JASA TERSEDIA FOR TUKANG
        // ===============================
        $tukang = Tukang::where('namatukang', 'Test Tukang Profesional')->first();
        if ($tukang) {
            $jenisPemesanan = JenisPemesanan::first();
            if ($jenisPemesanan) {
                $jasaExists = \App\JasaTersedia::where('id_tukang', $tukang->id_tukang)->first();
                if (!$jasaExists) {
                    // Jasa Harian
                    \App\JasaTersedia::create([
                        'id_tukang' => $tukang->id_tukang,
                        'id_jenispemesanan' => $jenisPemesanan->id_jenispemesanan,
                        'biayajasatersedia' => 150000, // 150rb per hari
                        'jenisjasatersedia' => '0', // Harian
                    ]);
                    
                    // Jasa Borongan
                    \App\JasaTersedia::create([
                        'id_tukang' => $tukang->id_tukang,
                        'id_jenispemesanan' => $jenisPemesanan->id_jenispemesanan,
                        'biayajasatersedia' => 2000000, // 2jt borongan
                        'jenisjasatersedia' => '1', // Borongan
                    ]);
                    $this->command->info('✓ Jasa Tersedia created for Tukang');
                }
            }
        }

        // ===============================
        // SUMMARY
        // ===============================
        $this->command->info('');
        $this->command->info('=== TEST ACCOUNTS READY ===');
        $this->command->info('┌─────────────┬─────────────────────────┬──────────────┐');
        $this->command->info('│ Role        │ Email                   │ Password     │');
        $this->command->info('├─────────────┼─────────────────────────┼──────────────┤');
        $this->command->info('│ Admin       │ admin@nukang.com        │ password123  │');
        $this->command->info('│ Pelanggan   │ pelanggan@nukang.com    │ password123  │');
        $this->command->info('│ Tukang      │ tukang@nukang.com       │ password123  │');
        $this->command->info('└─────────────┴─────────────────────────┴──────────────┘');
        $this->command->info('');
    }
}
