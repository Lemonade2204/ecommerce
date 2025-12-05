<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Order Detail')]
class MyOrderDetailPage extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
        
    }

    
    public function render()
    {
        $order = Order::findOrFail($this->order_id);
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        // If any ordered product is missing (deleted by admin), return 404
        foreach ($order_items as $item) {
            if (! $item->product) {
                abort(404);
            }
        }
        $address = Address::where('order_id', $this->order_id)->first();
        // $order = Order::where('id', $this->order_id)->first();
        
        return view('livewire.my-order-detail-page', [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $order,
        ]);
    }
}
