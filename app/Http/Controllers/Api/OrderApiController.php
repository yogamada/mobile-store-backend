<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderApiController extends Controller
{
    /**
     * Helper to verify if user is customer.
     */
    private function verifyCustomer()
    {
        $user = Auth::guard('api')->user();
        if (!$user || $user->role !== 'customer') {
            return false;
        }
        return true;
    }

    /**
     * Checkout shopping cart.
     */
    public function checkout(Request $request)
    {
        if (!$this->verifyCustomer()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Only customers can place orders.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $userId = Auth::guard('api')->id();
        $itemsData = $request->input('items');
        $totalAmount = 0;
        $orderItemsToCreate = [];

        // Validate stock and calculate prices
        try {
            DB::beginTransaction();

            foreach ($itemsData as $item) {
                $product = Product::find($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => "Insufficient stock for product: {$product->name}. Available: {$product->stock}"
                    ], 422);
                }

                $price = $product->price;
                $lineTotal = $price * $item['quantity'];
                $totalAmount += $lineTotal;

                // Decrement stock
                $product->decrement('stock', $item['quantity']);

                $orderItemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                ];
            }

            // Create Order
            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'status' => 'completed', // For the sake of simplicity, orders are auto-completed on checkout
            ]);

            // Create Order Items
            foreach ($orderItemsToCreate as $itemToCreate) {
                $itemToCreate['order_id'] = $order->id;
                OrderItem::create($itemToCreate);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Checkout successful',
                'order' => $order->load('items.product')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order history for customer.
     */
    public function history()
    {
        if (!$this->verifyCustomer()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Only customers can view order history.'
            ], 403);
        }

        $userId = Auth::guard('api')->id();
        $orders = Order::where('user_id', $userId)
                       ->with('items.product')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
}
