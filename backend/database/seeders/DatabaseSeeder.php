<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin (login di /admin)
        DB::table('admins')->updateOrInsert(
            ['email' => env('ADMIN_EMAIL', 'admin@sleephaven.id')],
            [
                'name' => 'Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password123')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $kasur = Category::firstOrCreate(['slug' => 'kasur'], ['name' => 'Kasur']);
        $bantal = Category::firstOrCreate(['slug' => 'bantal-guling'], ['name' => 'Bantal & Guling']);
        $aksesori = Category::firstOrCreate(['slug' => 'aksesori-tidur'], ['name' => 'Aksesori Tidur']);

        $products = [
            [$kasur, 'Kasur Busa Sleep Haven 160x200', 'kasur-busa-160x200', 'Kasur busa kepadatan tinggi, nyaman untuk tidur harian. Ukuran 160x200 cm.', 2500000, 10],
            [$kasur, 'Kasur Pocket Spring 180x200', 'kasur-pocket-spring-180x200', 'Kasur pegas pocket spring, tidak mengganggu pasangan saat bergerak. Ukuran 180x200 cm.', 4200000, 7],
            [$bantal, 'Bantal Microfiber Premium', 'bantal-microfiber-premium', 'Bantal microfiber lembut, isi penuh dan empuk.', 149000, 50],
            [$aksesori, 'Sprei Katun Navy 160x200', 'sprei-katun-navy-160x200', 'Sprei katun 100%, adem dan tidak luntur. Motif polos navy.', 329000, 30],
        ];

        foreach ($products as [$cat, $name, $slug, $desc, $price, $stock]) {
            Product::firstOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $cat->id,
                    'name' => $name,
                    'description' => $desc,
                    'price' => $price,
                    'stock' => $stock,
                    'is_active' => true,
                ]
            );
        }
    }
}
