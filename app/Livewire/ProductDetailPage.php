<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Product Detail')]
class ProductDetailPage extends Component
{

    public $slug;
    public $quantity =5;

    public function increaseQty(){
        $this->quantity++;
    }
    public function decreaseQty(){
        $this->quantity--;
    }
    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);


        LivewireAlert::title('Success')
            ->text('Product added to the cart successfully')
            ->position('bottom-end')
            ->timer(3000)
            ->toast()
            ->show();
    }
}
