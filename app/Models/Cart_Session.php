<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Cart_Session
{
    // use HasFactory;
    public $total_qty = 0;
    public $total_price = 0;
    public $items = null;

    public function __construct($old_cart)
    {
      if ($old_cart) {
        $this->total_qty = $old_cart->total_qty;
        $this->total_price = $old_cart->total_price;
        $this->items = $old_cart->items;
      }
    }

    public function add_cart_item($item,$id)
    {  $stored_item = ['qty'=>0,'price'=>$item->current_amount,'item'=>$item];
   if ($this->items) {
    if (array_key_exists($id,$this->items)) {
       $stored_item = $this->items[$id];
    }
   }
   ++$this->total_qty;
   $this->total_price += $item->current_amount;
   ++$stored_item['qty'];
   $this->items[$id] = $stored_item;
    }

    public function minus_cart_item($item,$id)
    {
   if ($this->items) {
    if (array_key_exists($id,$this->items)) {
       $stored_item = $this->items[$id];
    }
   }
   $this->total_price -= $item->current_amount;
   $stored_item['qty'] = $stored_item['qty'] - 1;
   $this->total_qty = $this->total_qty - 1;
   if ($stored_item['qty']<1) {
    unset($this->items[$id]);
   }else{
    $this->items[$id] = $stored_item;
   }
    }

    public function delete_cart_item($item,$id)
    {
   if ($this->items) {
    if (array_key_exists($id,$this->items)) {
       $stored_item = $this->items[$id];
    }
   }
   $this->total_price -= $item->current_amount * $stored_item['qty'];
   $this->total_qty -= $stored_item['qty'];
    unset($this->items[$id]);
    }



}
