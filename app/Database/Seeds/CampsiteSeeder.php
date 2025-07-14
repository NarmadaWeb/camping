<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CampsiteSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Puncak Gunung Salak',
                'description' => 'Terletak di ketinggian 1.200 mdpl, lokasi perkemahan ini menawarkan pemandangan yang menakjubkan dan udara yang sejuk. Cocok untuk keluarga dan kelompok yang mencari pengalaman berkemah yang menyenangkan.',
                'location' => 'Gunung Salak, Bogor, Jawa Barat',
                'price_per_night' => 250000,
                'capacity' => 6,
                'facilities' => 'Toilet umum, Area BBQ, Sumber air bersih, Tempat parkir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pantai Anyer Camping Ground',
                'description' => 'Nikmati pengalaman berkemah unik di tepi pantai dengan suara deburan ombak yang menenangkan. Sempurna untuk menikmati sunset dan sunrise spektakuler.',
                'location' => 'Pantai Anyer, Banten',
                'price_per_night' => 300000,
                'capacity' => 8,
                'facilities' => 'Toilet & kamar mandi, Warung makanan, Persewaan alat kemah, Pos keamanan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Ranca Upas',
                'description' => 'Bumi perkemahan yang luas dengan pemandangan gunung dan hutan pinus. Sering dikunjungi rusa liar dan merupakan habitat beragam flora dan fauna.',
                'location' => 'Ciwidey, Bandung, Jawa Barat',
                'price_per_night' => 200000,
                'capacity' => 10,
                'facilities' => 'Toilet & kamar mandi, Area BBQ, Warung makanan, Outbound area, Penangkaran rusa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Danau Toba Lakeside',
                'description' => 'Berlokasi di tepi Danau Toba dengan pemandangan danau dan Pulau Samosir yang indah. Menawarkan pengalaman berkemah yang unik dengan nuansa budaya Batak.',
                'location' => 'Parapat, Danau Toba, Sumatera Utara',
                'price_per_night' => 350000,
                'capacity' => 5,
                'facilities' => 'Toilet & kamar mandi, Persewaan perahu, Warung makan, Penjualan souvenir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Hutan Pinus Mangunan',
                'description' => 'Perkemahan di tengah hutan pinus yang asri dengan pemandangan matahari terbit yang menakjubkan. Lokasi populer untuk fotografi dan rekreasi keluarga.',
                'location' => 'Bantul, Yogyakarta',
                'price_per_night' => 180000,
                'capacity' => 4,
                'facilities' => 'Toilet umum, Warung sederhana, Jalur pendakian',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bukit Lawang Camp',
                'description' => 'Berkemah di perbatasan hutan hujan tropis dengan kesempatan melihat orangutan di habitat alaminya. Pengalaman alam yang luar biasa.',
                'location' => 'Bukit Lawang, Sumatera Utara',
                'price_per_night' => 400000,
                'capacity' => 6,
                'facilities' => 'Toilet & kamar mandi, Guide lokal, Warung makan, Persewaan peralatan trekking',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Savana Bromo',
                'description' => 'Berkemah di padang savana dengan pemandangan Gunung Bromo yang megah. Ideal untuk menikmati bintang di malam hari dan sunrise di pagi hari.',
                'location' => 'Taman Nasional Bromo Tengger Semeru, Jawa Timur',
                'price_per_night' => 280000,
                'capacity' => 3,
                'facilities' => 'Toilet umum, Persewaan kuda, Warung makan sederhana',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Telaga Cibeureum',
                'description' => 'Perkemahan di tepi danau dengan air yang jernih dan lingkungan yang sejuk. Cocok untuk kegiatan memancing dan bersantai dengan keluarga.',
                'location' => 'Sukabumi, Jawa Barat',
                'price_per_night' => 220000,
                'capacity' => 8,
                'facilities' => 'Toilet & kamar mandi, Area BBQ, Spot memancing, Persewaan alat pancing',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data to table
        $this->db->table('campsites')->insertBatch($data);
    }
}
