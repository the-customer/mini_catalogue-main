<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'tech'      => 'Tech',
            'maison'    => 'Maison',
            'mode'      => 'Mode'
        ];
        $categoryIds = [];
        //Creer les categories a partie des noms ($categoryNames)
        foreach($categoryNames as $slug => $name){
            $category = Category::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
            $categoryIds[$slug] = $category->id;
        }


        $products = [
            [
                'name' => 'Casque Bluetooth',
                'slug' => 'casque-bluetooth',
                'category' => 'tech',
                'price' => 35000,
                'old_price' => 40000,
                'stock' => 12,
                'image' => 'https://picsum.photos/seed/casque/600/400',
                'description' => 'Casque confortable, autonomie 20h, micro intégré.',
                'tags' => ['audio', 'wireless'],
                'featured' => true,
            ],
            [
                'name' => 'Montre Classique',
                'slug' => 'montre-classique',
                'category' => 'mode',
                'price' => 25000,
                'old_price' => 30000,
                'stock' => 8,
                'image' => 'https://picsum.photos/seed/montre/600/400',
                'description' => 'Montre élégante, bracelet cuir.',
                'tags' => ['style'],
                'featured' => false,
            ],
            [
                'name' => 'Lampe de Bureau',
                'slug' => 'lampe-bureau',
                'category' => 'maison',
                'price' => 18000,
                'old_price' => null,
                'stock' => 20,
                'image' => 'https://picsum.photos/seed/lampe/600/400',
                'description' => 'Éclairage doux, 3 intensités.',
                'tags' => ['deco'],
                'featured' => true,
            ],
            [
                'name' => 'Chargeur Rapide USB-C',
                'slug' => 'chargeur-rapide-usb-c',
                'category' => 'tech',
                'price' => 12000,
                'old_price' => null,
                'stock' => 40,
                'image' => 'https://picsum.photos/seed/chargeur/600/400',
                'description' => 'Chargeur 30W compatible USB-C PD.',
                'tags' => ['power', 'usb-c'],
                'featured' => false,
            ],
            [
                'name' => 'Sac à dos',
                'slug' => 'sac-a-dos',
                'category' => 'mode',
                'price' => 22000,
                'old_price' => null,
                'stock' => 15,
                'image' => 'https://picsum.photos/seed/sac/600/400',
                'description' => 'Sac robuste, idéal pour laptop et accessoires.',
                'tags' => ['bag'],
                'featured' => true,
            ],
            [
                'name' => 'Bougie parfumée',
                'slug' => 'bougie-parfumee',
                'category' => 'maison',
                'price' => 9000,
                'old_price' => null,
                'stock' => 30,
                'image' => 'https://picsum.photos/seed/bougie/600/400',
                'description' => 'Parfum doux, ambiance chaleureuse.',
                'tags' => ['home', 'scent'],
                'featured' => false,
            ],
            [
                'name' => 'Clavier mécanique',
                'slug' => 'clavier-mecanique',
                'category' => 'tech',
                'price' => 45000,
                'old_price' => null,
                'stock' => 10,
                'image' => 'https://picsum.photos/seed/clavier/600/400',
                'description' => 'Switches confortables, frappe précise.',
                'tags' => ['keyboard', 'gaming'],
                'featured' => true,
            ],
            [
                'name' => 'Tapis de salon',
                'slug' => 'tapis-salon',
                'category' => 'maison',
                'price' => 55000,
                'old_price' => null,
                'stock' => 5,
                'image' => 'https://picsum.photos/seed/tapis/600/400',
                'description' => 'Tapis doux, design moderne.',
                'tags' => ['deco', 'comfort'],
                'featured' => false,
            ],
        ];

        //creer les produits
        foreach($products as $data){
            //inserer la colonne category_id
            $data['category_id'] = $categoryIds[$data['category']];
            //supprimer la colonne category:
            unset($data['category']);
            //inserer dans la base de donnees:
            Product::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
