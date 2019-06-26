<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::truncate();

        for ($i = 1; $i <= 50; $i++) {
            $p = new Product();
            $p->name = "Produto ".$i;
            $p->stock = random_int(10, 100);
            $p->min = random_int(5, 20);
            $p->save();
        }
    }
}
