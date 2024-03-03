<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Controllers\CartManagerController;
use Livewire\Component;

class Cart extends Component
{
    public $carts;
    public $cart_amount;
    public $cart_total;
    private $cart_handler;
    public $status_message;

    public function __construct() {
        $this->cart_handler = new CartManagerController();
    }
    public function render()
    {
        $this->carts = $this->cart_handler->get();
        $this->CountCart();
        $this->cart_total = $this->cart_handler->cart_total();
        return view('livewire.frontend.cart')->extends('layouts.app', [
            'meta' => [
                "title" => "Cart | stygen",
                "image" => "",
                "og_image" => "",
                "twitter_image" => "",
                "description" => "",
                "price" => "" ,
                "keywords" => ""
            ],
        ]);
    }

    public function increase($id)
    {
        $this->cart_handler->qty_increase($id);
        $this->cart_total = $this->cart_handler->cart_total();
        $this->status_message = 'cartUpdated';
        // $this->emit('cartUpdated');
    }

    public function decrease($id)
    {
        $this->cart_handler->qty_decrease($id);
        $this->cart_total = $this->cart_handler->cart_total();
        $this->status_message = 'cartUpdated';
        // $this->emit('cartUpdated');
    }

    public function remove($id)
    {
        $this->cart_handler->remove($id);
        $this->cart_total = $this->cart_handler->cart_total();
        $this->status_message = 'cartRemoved';
        $this->CountCart();
        // $this->emit('cartRemoved');
    }

    public function quantityChange($qty, $id)
    {
        if($qty > 0) {
            $this->cart_handler->qty_change($qty, $id);
            $this->cart_total = $this->cart_handler->cart_total();
            $this->status_message = 'cartUpdated';
        }
        // $this->emit('cartUpdated');
    }

    public function CountCart()
    {
        $this->cart_amount = $this->cart_handler->cart_count();
    }
    // public function render()
    // {
    //     return view('livewire.frontend.cart');
    // }
}
