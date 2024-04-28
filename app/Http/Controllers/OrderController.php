<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Sla een nieuwe bestelling op in de database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Haal de opgeslagen producten op uit het verzoek
        $products = $request->input('products');

        // Maak een nieuwe bestelling aan
        $order = new Order();
        $order->save();

        // Loop door de opgeslagen producten en sla ze op als orderregels
        foreach ($products as $product) {
            $order->orderLines()->create([
                'product_name' => $product['name'],
                'price' => $product['price'],
                'aantal' => $product['count'],
                'subtotaal' => $product['subtotaal']
            ]);
        }

        return response()->json(['message' => 'Bestelling succesvol opgeslagen'], 200);
    }
}
