<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Electronics',
                'description' => 'Devices and gadgets',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing and accessories',
            ],
            [
                'name' => 'Home Appliances',
                'description' => 'Kitchen and home gadgets',
            ]
        ];

        // Insert data into product_category table
        $this->db->table('product_category')->insertBatch($data);
    }
}
