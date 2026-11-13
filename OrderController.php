<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        return view('orders.index', [
            'orders' => Order::where('user_id', auth()->id())->get(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'book_name'     => 'required',
            'quantity'      => 'required|integer',
            'delivery_date' => 'required|date',
        ]);
        Order::create([
            'user_id'       => auth()->id(),
            'book_name'     => $request->book_name,
            'quantity'      => $request->quantity,
            'delivery_date' => $request->delivery_date,
        ]);
        return redirect('/orders');
    }
}
