<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $barangsData = [
        [
            'nama' => 'Pensil',
            'harga' => 3000,
            'stok' => 10,
        ],
        [
            'nama' => 'Buku',
            'harga' => 10000,
            'stok' => 5,
        ],
        [
            'nama' => 'Penghapus',
            'harga' => 2000,
            'stok' => 15,
        ],
        [
            'nama' => 'Pulpen',
            'harga' => 5000,
            'stok' => 8,
        ],
        [
            'nama' => 'Penggaris',
            'harga' => 4000,
            'stok' => 12,
        ]
    ];
    public function run(): void
    {
        //
        foreach ($this->barangsData as $data) {
            Barang::create($data);
        }
    }
}
