<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::truncate();

        $events = ['buy', 'pay', 'buy-product', 'buy-product-new', 'pay-product', 'product-pay', 'product', 'pay-product-new'];
        $store_name = ['Elmo', 'Shopping DelRey', 'DiamonnMall', 'Amigao', 'Minas Shopping', 'Shopping DelRey', 'Loja de Bonés', 'Centauro Esportes'];
        $product_name = ['roupa', 'tenis', 'bone', 'mochila', 'camisa', 'bermuda', 'chinelo', 'celular', 'fone'];

        for ($i = 0; $i < 50; $i++) {
            $key_event = array_rand($events, 1);
            $key_store_name = array_rand($store_name, 1);
            $key_product_name = array_rand($product_name, 1);
            Event::create([
                'event' => $events[$key_event],
                'transaction_id' => rand(),
                'store_name' => $store_name[$key_store_name],
                'product_name' => $product_name[$key_product_name],
                'product_price' => mt_rand(1,2000),
            ]);
        }
    }
}
