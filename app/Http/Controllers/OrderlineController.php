<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\SaleOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderLineController extends Controller
{
    public function store(Request $request)
    {
        $products = $request->input('products');

        try {
            // Begin een database transactie
            DB::beginTransaction();

            // Maak een nieuwe verkooporder aan
            $order = new SaleOrder;
            $order->user_id = Auth::id(); // Gebruikers-ID van de ingelogde gebruiker
            $order->notitie = 'is hallo'; // Standaardnotitie (aanpassen indien nodig)
            $order->totaal_bedrag = 0; // Initialiseer totaalbedrag

            // Sla de verkooporder op voordat we orderregels aanmaken
            $order->save();

            $totalAmount = 0;

            foreach ($products as $product) {
                // Maak een nieuwe verkooporderregel aan voor elk product
                $orderLine = new SaleOrder;
                $orderLine->sale_order_id = $order->id;
                $orderLine->product_name = $product['name'];
                $orderLine->price = $product['price'];
                $orderLine->quantity = $product['quantity'];
                $orderLine->subtotal = $product['price'] * $product['quantity'];
                $orderLine->save();

                // Bereken het totaalbedrag van de order
                $totalAmount += $orderLine->subtotal;
            }

            // Update het totaalbedrag van de verkooporder
            $order->totaal_bedrag = $totalAmount;
            $order->save();

            // Commit de database transactie
            DB::commit();

            // Geef een succesrespons terug naar de client
            return response()->json(['message' => 'Order successfully created'], 201);
        } catch (\Exception $e) {
            // Bij een fout, rollback de database transactie
            DB::rollBack();

            // Log de fout
            Log::error('Error creating order: ' . $e->getMessage());

            // Geef een foutrespons terug naar de client
            return response()->json(['message' => 'Failed to create order'], 500);
        }
    }
}
