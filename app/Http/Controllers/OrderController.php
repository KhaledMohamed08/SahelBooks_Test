<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('Order.index', compact('items'));
    }

    public function calculateOrder(Request $request)
    {
        if(!$request->input('items'))
        {
            return view('Order.empty');
        }
        $itemsIds = $request->input('items');
        $items = $this->getItems($itemsIds);
        $subtotal = $this->calculateSubTotal($items);
        $shipping = $this->calculateShipping($items);
        $vat = $this->calculateVAT($items);
        $discounts = $this->calculateDiscounts($items);
        $total = ($subtotal + $shipping + $vat) - array_sum($discounts);
        $checkout = [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'vat' => $vat,
        ];
        if(count($discounts) > 0)
        {
            $checkout['discounts'] = $discounts;
        }
        
        return view('Order.checkout', compact('checkout', 'total'));
    }

    private function getItems($itemsIds)
    {
        $items = Item::whereIn('id', $itemsIds)->get();

        return $items;
    }

    private function calculateSubTotal($items)
    {
        $subtotal = 0;
        foreach($items as $item)
        {
            $subtotal += $item->price;
        }

        return $subtotal;
    }

    private function calculateShipping($items)
    {
        $shipping = 0;
        foreach($items as $item)
        {
            $shipping += $item->weight * 1000 / 100 * $item->shippingRate->rate;
        }

        return $shipping;
    }

    private function calculateVAT($items)
    {
        $vat = 0;
        foreach($items as $item)
        {
            $vat += $item->price / 100 * 14;
        }

        return $vat;
    }

    private function calculateDiscounts($items)
    {
        $discounts = [];
        $shippingDiscount = $this->calculateShippingDiscount($items);
        $jacketDiscount = $this->calculateJacketDiscount($items);
        $shoesDiscount = $this->calculateShoesDiscount($items);
        if($shoesDiscount > 0)
        {
            $discounts['10% of shoes'] = $shoesDiscount;
        }
        if($jacketDiscount > 0)
        {
            $discounts['50% of jacket'] = $jacketDiscount;
        }
        if($shippingDiscount > 0)
        {
            $discounts['10% of shipping (max $10)'] = $shippingDiscount;
        }

        return $discounts;

    }

    private function calculateShippingDiscount($items)
    {
        if ($items->count() > 1) {
            $shipping = $items->sum(function ($item) {
                return $item->weight * 1000 / 100 * $item->shippingRate->rate;
            });
            $shippingDiscount = min($shipping / 100 * 10, 10);

            return $shippingDiscount;
        }
        
        return 0;
    }


    private function calculateJacketDiscount($items)
    {
        $numberOfTops = $this->countTops($items);
        $hasJacket = $items->contains(function ($item) {
            return $item->type == 'Jacket';
        });

        return ($numberOfTops > 1 && $hasJacket) ? $this->getJacketPrice() * 0.5 : 0;
    }


    private function countTops($items)
    {
        return $items->filter(function ($item) {
            return in_array($item->type, ['T-shirt', 'Blouse']);
        })->count();
    }

    private function calculateShoesDiscount($items)
    {
        $shoesDiscount = 0;

        foreach ($items as $item) {
            if ($item->type == 'Shoes') {
                $shoesDiscount += $item->price * 0.1;
            }
        }

        return $shoesDiscount;
    }

    private function getJacketPrice()
    {
        return Item::where('type', 'Jacket')->value('price');
    }
}
